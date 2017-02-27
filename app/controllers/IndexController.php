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

namespace RNTForest\OVZCP\controllers;

use \RNTForest\ovz\models\PhysicalServers;
use \RNTForest\ovz\models\VirtualServers;
use \RNTForest\ovz\models\Dcoipobjects;
use \RNTForest\core\libraries\Helpers;
use \RNTForest\core\libraries\PDF;

class IndexController extends \RNTForest\core\controllers\IndexControllerBase
{

    /**
    * Testing area
    *     
    */
    public function scanAllVSAction(){
        // push service
        $push = $this->getPushService();

        // get all PhysicalServer
        $physicalServers = PhysicalServers::find(["ovz=1"]);
        if (!$physicalServers) {
            $this->flashSession->error("No OVZ enabled Physical Servers found");
            return $this->redirectTo("virtual_servers/slidedata");
        }

        // scan each
        foreach($physicalServers as $physicalServer){

            // execute ovz_list_vs job        
            $params = array();
            $job = $push->executeJob($physicalServer,'ovz_list_vs',$params);
            if(!$job || $job->getDone()==2){
                $this->flashSession->error("Job (ovz_list_vs) executions failed");
                return $this->redirectTo("index/index");
            }

            // scan VS
            $vsList = $job->getRetval(true);
            foreach($vsList as $vs){
                // fetch settins
                $params = array('UUID'=>$vs['uuid']);
                $job = $push->executeJob($physicalServer,'ovz_list_info',$params);
                if(!$job || $job->getDone()==2){
                    $this->flashSession->error("Job (ovz_list_info) executions failed!");
                    continue;
                }
                $settings = $job->getRetval(true);

                // compare settings
                $virtualServer = VirtualServers::findFirst("ovz_uuid = '".$vs['uuid']."'");
                if(!$virtualServer){
                    // Insert new server
                    $virtualServer = new VirtualServers();
                    $virtualServer->setOvzUuid($vs['uuid']);
                }

                // update fields
                $virtualServer->setName(substr($settings['Name'],0,40));
                $virtualServer->setDescription($settings['Description']);
                $virtualServer->setCustomersId($physicalServer->getCustomersId());
                $virtualServer->setPhysicalServersId($physicalServer->getId());
                $virtualServer->setOvz(1);
                $virtualServer->setOvzSettings($job->getRetval());
                $virtualServer->setOvzVstype($settings['Type']);
                $virtualServer->setCore(intval($settings['Hardware']['cpu']['cpus']));
                $virtualServer->setMemory(intval(Helpers::convertToBytes($settings['Hardware']['memory']['size'])/1024/1024));
                $virtualServer->setSpace(intval(Helpers::convertToBytes($settings['Hardware']['hdd0']['size'])/1024/1024/1024));
                $virtualServer->setActivationDate(date("Y-m-d"));

                // save virtual server
                if ($virtualServer->save() === false) {
                    $this->flashSession->error("Virtual Server (".$virtualServer->getName().") save failed.");
                    $messages = $virtualServer->getMessages();
                    foreach ($messages as $message) {
                        $this->flashSession->warning($message);
                    }
                    return $this->redirectTo("index/index");
                } else {
                    $this->flashSession->success("Virtual (".$virtualServer->getName().") Server sucessfully saved/updated.");
                }

                // save IPs
                if(isset($settings['Hardware']['venet0']['ips'])){
                    $ips = explode(" ",$settings['Hardware']['venet0']['ips']);
                    foreach($ips as $ipAddress){
                        $parts = explode("/",$ipAddress);
                        $ip = new Dcoipobjects();
                        $ip->setValue1($parts[0]);
                        if(!empty($parts[0])) $ip->setValue2($parts[1]);
                        $ip->checkVersion();
                        if($ip->isValidIP($parts[0])){
                            $found = Dcoipobjects::findFirst("value1 = '".$parts[0]."'");
                            if($found) continue;
                            $ip->setType(Dcoipobjects::TYPE_IPADDRESS);
                            $ip->setAllocated(Dcoipobjects::ALLOC_AUTOASSIGNED);
                            $ip->setVirtualServersId($virtualServer->getId());
                            if($ip->save() === false){
                                $this->flashSession->error("IP Address (".$ipAddress.") save failed.");
                                $messages = $ip->getMessages();
                                foreach ($messages as $message) {
                                    $this->flashSession->warning($message);
                                }
                            }
                        }
                    }
                }
            }
        }

        return $this->redirectTo("index/index");
    }

    /**
    * The methode is collecting the permissionbase information
    * and then putting it out as an PDF file.
    */
    public function genPermissionsPDFAction(){
        // create PDF Object, set date variable,
        $this->PDF = new PDF();
        $this->PDF->setPrintHeader(false);
        $permissions = $this->config->permissionbase;
        $date = date("F j, Y");

        //Author and title        
        $this->PDF->SetAuthor('ARONET GmbH');
        $this->PDF->SetTitle('Permissions');
        $this->PDF->SetTopMargin(11);

        //Creating page with title and date on top
        $this->PDF->AddPage();
        $this->PDF->SetFont('', 'B', 19);
        $this->PDF->Cell(0, 0, 'Permissionbase', 0, 1, '', 0, '', 0);

        $this->PDF->SetFont('', '', 12);
        $this->PDF->Cell(0,0, $date, 0, 1, '', 0, '', 0);
        $this->PDF->Ln(6);

        // print Logo
        if(key_exists('logo',$this->config->pdf)){
            if(file_exists(BASE_PATH.$this->config->pdf['logo'])) {
                $this->PDF->Image(BASE_PATH.$this->config->pdf['logo'], 180, 10, 20, 20, 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);
            }
        }

        //Zwei Spalte definieren        
        $this->PDF->resetColumns();
        $this->PDF->setEqualColumns(2);
        
        //Creating a title for each main category
        foreach ($permissions as $key=>$kategorie) {
            $this->PDF->SetFillColor(100);
            $this->PDF->SetTextColor(255);
            $this->PDF->SetFont('', 'B', 9);

//            if ($this->PDF->getY() > ($this->PDF->getPageHeight() - 60)) {
//                $this->PDF->AddPage();
//            }

            $this->PDF->Cell(0,0,$key, 0, 2, '',true);
            //creating a title for each under-category   
            foreach ($kategorie as $key=>$firstobj){
                $this->PDF->SetTextColor(0);
                $this->PDF->SetFont('', 'B', 7);
                $this->PDF->SetFillColor(220);

//                if ($this->PDF->getY() > ($this->PDF->getPageHeight() - 60)) {
//                    $this->PDF->AddPage();
//                }
                //Setting the absolut position to 15 and creating the cell with the informations
//                $this->PDF->SetAbsX(15);
                $this->PDF->Cell(0,0,$key.": ".$firstobj->description, 0, 2,'', true);

                //Setting the absolut position to 10 and writing the title scopes
                $this->PDF->SetFont('', 'B', 6);
//                $this->PDF->SetAbsX(20);
                $this->PDF->Cell(0,0,"scopes: ", 0, 2,'', false);
                $this->PDF->SetFont('', '', 6);
                //Printing all the scope information
                foreach ($firstobj->scopes as $key=>$secondobj){
//                    $this->PDF->SetAbsX(23);
                    $this->PDF->Cell(0,0,$key.": ".$secondobj, 0, 2,'', false);    
                }
                $this->PDF->Ln(1);
                //Settigng the absolut posititon to 20 and printing out actions
                foreach ($firstobj->actions as $thirdobj){
                    $actions_elemente = "";
                    $this->PDF->SetFont('', 'B', 6);
//                    $this->PDF->SetAbsX(20);
                    $this->PDF->Cell(0,0,"actions: ", 0, 2,'', false);
                    $this->PDF->SetFont('', '', 6);
                    //Getting all the actions and saving information into variable
                    foreach ($thirdobj as $result){
                        $actions_elemente .= $result.", ";    
                    }
                    //Printing out the variable with the actions
//                    $this->PDF->SetAbsX(23);
                    $this->PDF->MultiCell(0,0,$actions_elemente,0,1,false,1);   
                }   
            }
            $this->PDF->Ln(2);
        }

        // dispaly the PDF on the monitor
        $this->PDF->Output('permission.pdf', 'I');
        die();
    }


    public function genOVZJobsPDFAction(){
        // for all jobs
        $jobs = $this->genJobsUsages();
        
        // or this style for only ovz jobs
        //$jobs = $this->genJobsUsages(['ovz']);

        // create PDF Object, set date variable,
        $this->PDF = new \TCPDF();
        $this->PDF->setPrintHeader(false);
        $date = date("F j, Y");

        //Author and title        
        $this->PDF->SetAuthor('ARONET GmbH');
        $this->PDF->SetTitle('OVZ Jobs');
        $this->PDF->SetTopMargin(11);

        $this->PDF->AddPage();
        $this->PDF->SetFont('', 'B', 16);
        $this->PDF->Cell(0, 0, 'OVZ Jobs', 0, 1, '', 0, '', 0);

        $this->PDF->SetFont('', '', 10);
        $this->PDF->Cell(0,0, $date, 0, 1, '', 0, '', 0);
        $this->PDF->Ln(4);

        foreach($jobs as $key=>$val){
            // just some output to list jobs, rest todo
            $this->PDF->Cell(0,0, $key, 0, 1, '', 0, '', 0);
        }
        
        // dispaly the PDF on the monitor
        $this->PDF->Output('OVZJobsPDF.pdf', 'I'); 
        die();
    }
    
    /**
    * Gen an array of the usages of Jobs in ovzhost/...../jobs/......Job.php Files.
    * Returns an associative array with key ClassName and val the representative array of the Jobs usage() method.
    * The relevant Jobs can be filtered.
    * e.g. ['general'] if only general or ['ovz'] if only ovz or ['ovz','something'] if ovz or something
    * Abstract...Jobs are ignored.
    * 
    * @param array $filter optional
    */
    private function genJobsUsages($filters = array()){
        $jobUsages = array();
        
        $directory = new \RecursiveDirectoryIterator($_SERVER['DOCUMENT_ROOT'].'/../vendor/rnt-forest/ovz/ovzhost/ovzjob',\FilesystemIterator::SKIP_DOTS);
        $iterator = new \RecursiveIteratorIterator($directory);
        foreach ($iterator as $info) {
            $localFilepath = $info->getPathname();
            // only Files ending with Job.php and which are in subdir jobs are relevant
            if(preg_match('`\/\w*\/jobs\/.*Job.php$`',$localFilepath,$matches)){
                // in the first match element there should be the subpath to gen the fully qualified classpath
                $parts = explode('/',$matches[0]);
                if($parts[2]=='jobs'){
                    // filter only relevant jobs if $filters is set
                    if(!empty($filters)){
                        $ignore = true;
                        foreach($filters as $filter){
                            if($parts[1] == $filter) $ignore = false;
                        }
                        if($ignore) continue;
                    }
                    // build the classpath with namespace
                    $topNamespace = "\\RNTFOREST\\OVZJOB";
                    $midNamespace = "\\".$parts[1]."\\jobs\\";
                    $className = explode('.',$parts[3])[0];
                    $fullClassPath = $topNamespace.$midNamespace.$className;
                    
                    // ignore Abstract...Job classes
                    if(!preg_match('`Abstract.*Job$`',$className)){
                        // call static method so that no instantiation is needed (no context ...)
                        $jobUsages[$className] = $fullClassPath::usage();   
                    }
                }
            }
        }
        
        return $jobUsages;
    }
}
