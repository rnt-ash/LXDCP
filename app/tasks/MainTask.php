<?php

use Phalcon\Cli\Task;

use RNTForest\core\services\Push;
use RNTForest\lxd\models\VirtualServers;

class MainTask extends Task
{
    public function mainAction()
    {
        echo "Main aufgerufen..." . PHP_EOL;

        try{
            // find virtual server
            $virtualServers = VirtualServers::find("ovz=1");
            if (!$virtualServers) throw new \Exception("No Virtual Servers found");

            foreach($virtualServers as $virtualServer){

                // execute ovz_statistics_info job 
                $push = $this->di['push'];
                $params = array('UUID'=>$virtualServer->getOvzUuid());
                $job = $push->executeJob($virtualServer->PhysicalServers,'ovz_statistics_info',$params);
                if($job->getDone()==2) throw new \Exception("Job (ovz_statistics_info) executions failed: ".$job->getError());

                // save statistics
                $statistics = $job->getRetval(true);
                $virtualServer->setOvzStatistics($job->getRetval());

                if ($virtualServer->update() === false) {
                    $messages = $virtualServer->getMessages();
                    foreach ($messages as $message) {
                        $this->logger->warning($message);
                    }
                    throw new \Exception("Update Virtual Server (".$virtualServer->getName().") failed.");
                }
            }

        }catch(\Exception $e){
            $this->logger->error($e->getMessage());
        }

        echo "Main aufuf beendet..." . PHP_EOL;
    }
}
?>
