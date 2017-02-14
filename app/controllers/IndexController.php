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

}

