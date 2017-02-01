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

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->auth = $this->session->get("auth");
    }

    public function toggleSidebarAction(){
        // Toggle Zustand wechseln
        if($this->session->sidebarToggled == false){
            $this->session->sidebarToggled = true;
        }else{
            $this->session->sidebarToggled = false;
        }
        return 'OK';
    }

    public function fakerAction(){
        $faker = Faker\Factory::create("de_CH");

        $count = 10;

        // Generieren von Kunden
        for($i=0;$i<=($count);$i++){
            $customer = new Customers();
            $customer->setLastname($faker->lastName);
            $customer->setFirstname($faker->firstName);
            $customer->setCompany($faker->company);
            $customer->setCompanyAdd($faker->companySuffix);
            $customer->setStreet($faker->streetName);
            $customer->setZip($faker->postcode);
            $customer->setCity($faker->city);
            $customer->setPhone($faker->phoneNumber);
            $customer->setEmail($faker->email);
            $customer->setWebsite("www.".$faker->domainName);
            $customer->setActive(true);

            if (!$customer->save()) {
                foreach ($customer->getMessages() as $message) {
                    $this->flashSession->error($message);
                }
                return;
            }
            $this->flashSession->success("Customer: ".$customer->getCompany()." was created successfully");
        }

        // Generieren von Colocations
        for($i=0;$i<=($count/5);$i++){
            $colocation = new Colocations();
            $city = $faker->city;
            $colocation->setName("Colo ".$city." ".$faker->postcode);

            $rand = rand(1,Customers::count()-1);
            $customer = Customers::findFirst(array('offset'=>$rand));
            $colocation->setCustomersId($customer->getId());

            $colocation->setDescription($faker->sentence);
            $colocation->setLocation($city);
            $colocation->setActivationDate($faker->date($format = 'Y-m-d', $max = 'now'));

            if (!$colocation->save()) {
                foreach ($colocation->getMessages() as $message) {
                    $this->flashSession->error($message);
                }
                return;
            }
            $this->flashSession->success("Colocation: ".$colocation->getName()." was created successfully");
        }

        // Generieren von Physical Servers
        for($i=0;$i<=($count);$i++){
            $physicalServer = new PhysicalServers();
            $physicalServer->setName("Phys ".key($faker->canton)." ".$faker->buildingNumber);
            $physicalServer->setDescription($faker->sentence);

            $rand = rand(1,Customers::count()-1);
            $customer = Customers::findFirst(array('offset'=>$rand));
            $physicalServer->setCustomersId($customer->getId());

            $rand = rand(1,Colocations::count()-1);
            $colocation = Colocations::findFirst(array('offset'=>$rand));
            $physicalServer->setColocationsId($colocation->getId());

            $physicalServer->setPublicKey($faker->sha256);
            $physicalServer->setOvz(0);
            $physicalServer->setFqdn($faker->username.".".$faker->domainName);
            $physicalServer->setCore(rand(1,16));
            $physicalServer->setMemory(rand(1,1024*1024));
            $physicalServer->setSpace(rand(1,1024*1024));
            $physicalServer->setActivationDate($faker->date($format = 'Y-m-d', $max = 'now'));

            if (!$physicalServer->save()) {
                foreach ($physicalServer->getMessages() as $message) {
                    $this->flashSession->error($message);
                }
                return;
            }
            $this->flashSession->success("Physical Server: ".$physicalServer->getName()." was created successfully");
        }

        // Generieren von Virtual Servers
        for($i=0;$i<=($count);$i++){
            $virtualServer = new VirtualServers();
            $virtualServer->setName("Virt ".key($faker->canton)." ".$faker->buildingNumber);
            $virtualServer->setDescription($faker->sentence);

            $rand = rand(1,Customers::count()-1);
            $customer = Customers::findFirst(array('offset'=>$rand));
            $virtualServer->setCustomersId($customer->getId());

            $rand = rand(1,PhysicalServers::count()-1);
            $physicalServer = PhysicalServers::findFirst(array('offset'=>$rand));
            $virtualServer->setPhysicalServersId($physicalServer->getId());

            $virtualServer->setPublicKey($faker->sha256);
            $virtualServer->setOvz(0);
            $virtualServer->setFqdn($faker->username.".".$faker->domainName);
            $virtualServer->setCore(rand(1,16));
            $virtualServer->setMemory(rand(1,1024*1024));
            $virtualServer->setSpace(rand(1,1024*1024));
            $virtualServer->setActivationDate($faker->date($format = 'Y-m-d', $max = 'now'));
            $virtualServer->setPending(false);

            if (!$virtualServer->save()) {
                foreach ($virtualServer->getMessages() as $message) {
                    $this->flashSession->error($message);
                }
                return;
            }
            $this->flashSession->success("Virtual Server: ".$virtualServer->getName()." was created successfully");
        }

        // Generieren von DCO IP Objects
        for($i=0;$i<=($count);$i++){
            $dcoipobjects = new Dcoipobjects();
            $dcoipobjects->setVersion(Dcoipobjects::VERSION_IPV4);
            $dcoipobjects->setType(Dcoipobjects::TYPE_IPADRESS);
            $dcoipobjects->setValue1($faker->ipv4);
            $dcoipobjects->setAllocated(Dcoipobjects::ALLOC_RESERVED);

            // IP-Adressen an DCOs zuweisen
            $dcotype = rand(1,3);
            switch($dcotype){
                case 1:
                    $rand = rand(1,Colocations::count()-1);
                    $colocations = Colocations::findFirst(array('offset'=>$rand));
                    $dcoipobjects->setColocationsId($colocations->getId());
                case 2:
                    $rand = rand(1,PhysicalServers::count()-1);
                    $physicalServer = PhysicalServers::findFirst(array('offset'=>$rand));
                    $dcoipobjects->setPhysicalServersId($physicalServer->getId());
                case 3:
                    $rand = rand(1,VirtualServers::count()-1);
                    $virtualServer = VirtualServers::findFirst(array('offset'=>$rand));
                    $dcoipobjects->setVirtualServersId($virtualServer->getId());
                default:
            }
            $dcoipobjects->setComment($faker->text);

            if (!$dcoipobjects->save()) {
                foreach ($dcoipobjects->getMessages() as $message) {
                    $this->flashSession->error($message);
                }
                return;
            }
            $this->flashSession->success("DCO IP Object: ".$dcoipobjects->getValue1()." was created successfully");
        }

        $this->flashSession->success("fill up successfully");

        $this->dispatcher->forward([
            'controller' => "index",
            'action' => 'index'
        ]);
    }

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
                $virtualServer->setMemory(intval(\Helpers::convertToBytes($settings['Hardware']['memory']['size'])/1024/1024));
                $virtualServer->setSpace(intval(\Helpers::convertToBytes($settings['Hardware']['hdd0']['size'])/1024/1024/1024));
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

