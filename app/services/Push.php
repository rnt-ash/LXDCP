<?php
/**
* @copyright Copyright (c) ARONET GmbH (https://aronet.swiss)
* @license AGPL-3.0
*
* This code is free software: you can redistribute it and/or modify
* it under the terms of the GNU Affero General Public License, version 3,
* as published by the Free Software Foundation.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU Affero General Public License for more details.
*
* You should have received a copy of the GNU Affero General Public License, version 3,
* along with this program.  If not, see <http://www.gnu.org/licenses/>
*
*/

use Phalcon\Di\FactoryDefault;      

/**
* Service to push Jobs to Remoteserver.
* 
* Recommended use in Web-App:
* - Simple Jobs can be directly pushed with Method executeJob()
* 
* Recommended use for periodic Cronjob:
* - Push all open Jobs with Method pushJobs().
* 
* Advanced use in Web-App:
* - Jobs with dependencies to other Jobs should be queued with Method queueDependentJob() and will be pushed later in background.
* - it is possible to push all Jobs from the Web-App with Method pushJobs(), but it is not recommended
* 
* - if needed you can specify sequences that should be executed additionally with Method setSideEffect. For further
*   information see this Methods PHP-Doc and Documentation of the needed interface.
*  => Siedeeffects müssen überarbeitet werden bzw. ersetzt mit locking Funktionen => zu besprechen.
*/
class Push extends \Phalcon\DI\Injectable
{
    /**
    * @var FactoryDefault
    */
    private $di;
    
    /**
    * @var SideEffectInterface
    */
    private $SideEffect;
    
    public function __construct(FactoryDefault $di){
        $this->di = $di;
        $this->SideEffect = new NoSideEffect(); 
    }
    
    /**
    * Set the Effects which should be done to:
    * - check if Job can be directly executed
    * - make changes to something before push begins
    * - make changes to something after push ends
    * 
    * @param SideEffectInterface $sideEffect
    */
    public function setSideEffect(SideEffectInterface $sideEffect){
        $this->SideEffect = $sideEffect;
    }

    /**
    * To execute simple jobs without dependencies to other jobs.
    *   - checks if there are open jobs for this element on this server
    *   - inserts the job on managementserver
    *   - pushes job to remoteserver and receives return values
    * 
    * Requires valid $params array
    * 
    * @param JobServerInterface $server
    * @param string $jobType
    * @param array $params
    * 
    * @return Jobs $job
    */
    public function executeJob(JobServerInterface $server, $jobType, $params){
        try{
            if(!$this->SideEffect->canBeExecuted($jobType, $params)){
                throw new Exception("Job cannot be directly executed. Either wait until Jobs are finished or work with queueDependentJob.");
            }
            
            $job = $this->insertJob($server,$jobType, $params);
            if($job->getDone()==2) return $job;

            $errormessage = $this->pushJob($job); 
            if(!empty($errormessage)){
                throw new Exception("Execute Job failed: ".$errormessage);
            }
            
        }catch (Exception $e){
            $this->logger->error($e->getMessage());
            $job->setDone(2);
            $job->setError($e->getMessage());
        }
        return $job; 
    }  
    
    /**
    * To execute jobs with dependencies to other jovs.
    *   - inserts the job on managementserver
    * 
    * Requires valid $params array
    * 
    * @param JobServerInterface $server
    * @param string $jobType
    * @param array $params
    * @param int $dependencyId
    * 
    * @return Jobs $job
    */
    public function queueDependentJob(JobServerInterface $server, $jobType, $params, $dependencyId){
        return $this->insertJob($server, $jobType, $params, $dependencyId);
    }

    /**
    * Inserts job on db of managementserver.
    * 
    * @param JobServerInterface $jonbserver
    * @param string $jobType
    * @param array $params
    * @param array $options Bsp: array("dependency"=>"17")
    * 
    * @return Jobs $job
    */
    private function insertJob(JobServerInterface $server,$jobType,$params,$dependency=NULL){
        // Insert Job soll in jedem Fall ein Job Objekt zurückgeben
        $job = new Jobs();
        try{
            $job->setServer($server);

            $job->setLoginsId($this->session->get('auth')['id']);
            // ToDo -o Phalcon: User ID auf 1 setzen wenn Script via CLI aufgerufen wird

            $job->setType($jobType);
            $job->setParams(json_encode($params, JSON_UNESCAPED_UNICODE));
            $job->setDependency($dependency);

            if(!$job->save()) throw new Exception('Job insert failed:'.implode(", ",$job->getMessages()));
            $job->refresh();
            
        }catch (Exception $e){
            $this->logger->error($e->getMessage());
            $job->setDone(2);
            $job->setError($e->getMessage());
        }
        return $job; 
    }

    /**
    * Pushes open jobs from managementserver to the respective remoteserver.
    * 
    * @return boolean
    */
    public function pushJobs(){
        try{
            $ok = true;
            // collect pusherrors from all jobs and throw the exception if needed at the end 
            // so that a failed job does not affect all other jobs
            $pushErrors = '';

            // All open jobs
            $jobs = Jobs::find(["done < '1'", ]);
            foreach ($jobs as $job) {
                $pushErrors .= $this->pushJob($job);
            }
            
            if(!empty($pushErrors)){
                throw new Exception('Es sind Probleme bei der Ausführung von Jobs aufgetreten: '.$pushErrors);
            }
            
        }catch (Exception $e){
            $this->logger->error($e->getMessage());
            $ok = false;
        }

        return $ok; 
    }
    
    /**
    * Push the specified Job.
    * 
    * @param Jobs $job
    * @return string Error message or empty string
    */
    private function pushJob(\Jobs $job){
        $error = "";
        
        if(!$this->checkJobDependencies($job)){
            if($job->getDone() > 1){
                $error = "Job (ID ".$job->getId().") cannot be executed and has failed because the parent Job failed.";
            }else{
                $error = "Job (ID ".$job->getId().") cannot be executed because parent Job hasn't finished successfully yet.";
            }    
        }else{
            $this->SideEffect->doBeforePush($job->getType(), json_decode($job->getParams(),true));
                
            //Todo: Cleanup, this method has a lot of codeduplication
            
            $fqdn = $job->getServer()->getFqdn();
                    
            // if already sent: just try to receive new infos
            if($job->getSent()!='0000-00-00 00:00:00'){
                try{
                    $arrayGetBody = array("method"=>"getJob","id"=>$job->getId());
                    $encodedGetBody = JWT::encode($arrayGetBody,$this->di['config']->push['jwtsigningkey']);
                    $encodedGetResponse = HttpClient::connect($fqdn, 8000)->doPost("/",$encodedGetBody);

                    // decode response
                    $decodedGetResponse = (array) JWT::decode($encodedGetResponse,$this->di['config']->push['jwtsigningkey']);
                                
                    // update db of managementserver
                    if(!key_exists('id',$decodedGetResponse)){
                        throw new Exception("Key id existiert nicht in Response.");
                    }
                    if(!key_exists('executed',$decodedGetResponse)){
                        throw new Exception("Key executed existiert nicht in Response.");
                    }
                    if(!key_exists('done',$decodedGetResponse)){
                        throw new Exception("Key done existiert nicht in Response.");
                    }
                    if(!key_exists('error',$decodedGetResponse)){
                        throw new Exception("Key error existiert nicht in Response.");
                    }
                    if(!key_exists('retval',$decodedGetResponse)){
                        throw new Exception("Key retval existiert nicht in Response.");
                    }          
                    $job->setExecuted($decodedGetResponse['executed']);    
                    $job->setDone($decodedGetResponse['done']);    
                    $job->setError($decodedGetResponse['error']);    
                    $job->setRetval($decodedGetResponse['retval']);
                    if(!$job->save()) throw new Exception('Job update failed:'.implode(", ",$job->getMessages()));
                    $job->refresh();
                    
                    // if job was updated on managementserver and done is bigger than 0 (success or error)
                    // the job can be deleted from the remoteserver
                    if($job->getDone() > 0){
                        $arrayDeleteBody = array("method"=>"delJob","id"=>$job->getId());
                        $encodedDeleteBody = JWT::encode($arrayDeleteBody,$this->di['config']->push['jwtsigningkey']);
                        $encodedDeleteResponse = HttpClient::connect($fqdn, 8000)->doPost("/",$encodedDeleteBody);

                        // decode response
                        $decodedDeleteResponse = (array) JWT::decode($encodedDeleteResponse,$this->di['config']->push['jwtsigningkey']);
                        
                    }
                    }catch(Exception $e){
                        $this->logger->error($e->getMessage());
                        $error = $e->getMessage();
                    }
            }
            // otherwise also build
            else{
                // build job for transfer
                $arrayBody = array();
                $arrayBody["method"] = "runJob";
                $arrayBody["id"] = $job->getId();
                $arrayBody["type"] = $job->getType();
                $arrayBody["params"] = $job->getParams();

                try{
                    // encode message for transfer
                    $encodedBody = JWT::encode($arrayBody,$this->di['config']->push['jwtsigningkey']);
                    $encodedResponse = HttpClient::connect($fqdn, 8000)->doPost("/",$encodedBody);
                    
                    // update job in db after sending
                    $job->setSent(date("Y-m-d H:i:s"));
                    if(!$job->save()) throw new Exception('Job update failed:'.implode(", ",$job->getMessages()));
                    
                    // decode response
                    $decodedResponse = (array) JWT::decode($encodedResponse,$this->di['config']->push['jwtsigningkey']);
                
                    // update db of managementserver
                    if(!key_exists('id',$decodedResponse)){
                        throw new Exception("Key id existiert nicht in Response.");
                    }
                    if(!key_exists('executed',$decodedResponse)){
                        throw new Exception("Key executed existiert nicht in Response.");
                    }
                    if(!key_exists('done',$decodedResponse)){
                        throw new Exception("Key done existiert nicht in Response.");
                    }
                    if(!key_exists('error',$decodedResponse)){
                        throw new Exception("Key error existiert nicht in Response.");
                    }
                    if(!key_exists('retval',$decodedResponse)){
                        throw new Exception("Key retval existiert nicht in Response.");
                    }          
                    $job->setExecuted($decodedResponse['executed']);    
                    $job->setDone($decodedResponse['done']);    
                    $job->setError($decodedResponse['error']);    
                    $job->setRetval($decodedResponse['retval']);
                    if(!$job->save()) throw new Exception('Job update failed:'.implode(", ",$job->getMessages()));
                    
                    // if job was updated on managementserver and done is bigger than 0 (success or error)
                    // the job can be deleted from the remoteserver
                    if($job->getDone() > 0){
                        $arrayDeleteBody = array("method"=>"delJob","id"=>$job->getId());
                        $encodedDeleteBody = JWT::encode($arrayDeleteBody,$this->di['config']->push['jwtsigningkey']);
                        $encodedDeleteResponse = HttpClient::connect($fqdn, 8000)->doPost("/",$encodedDeleteBody);
                        
                        // decode response
                        $decodedDeleteResponse = (array) JWT::decode($encodedDeleteResponse,$this->di['config']->push['jwtsigningkey']);
                        
                    }
                }catch(Exception $e){
                    $this->logger->error($e->getMessage());
                    $error = $e->getMessage();
                }    
            }
            $this->SideEffect->doAfterPush($job->getType(), json_decode($job->getParams(),true), $job->getDone());
        }
        return $error;
    }
    
    /**
    * Checks if the specified Job has no Dependency to other jobs or the parent job has already finished successfully.
    * If the parent Job has finished with error (done 2 or 3) the dependent Job fails too.
    * 
    * @param Jobs $job
    * @return true if can be executed and false if not
    */
    private function checkJobDependencies(\Jobs &$job){
        $executable = true;
        if($job->getDependency() != 0){
            $parentJob = Jobs::findFirst("id = '".$job->getDependency()."'");
            $parentDone = $parentJob->getDone();
            if($parentDone != 1){
                $executable = false;
                
                if($parentDone > 1){
                    $job->setDone($parentDone);
                    $job->save();    
                }
            }
        }
        return $executable;
    }
}
