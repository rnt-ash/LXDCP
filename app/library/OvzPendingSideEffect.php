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

class OvzPendingSideEffect implements SideEffectInterface
{
    // Eventuell könnte man dies irgendwo zentral auslagern, das wird ja vielleicht auch sonst noch irgendwo verwendet
    private static $DONE_RUNNING = -1;
    private static $DONE_NOT_STARTED = 0;
    private static $DONE_SUCCESSFULL = 1;
    private static $DONE_FAILED = 2;
    private static $DONE_CRITICAL = 3;
    
    private static $PENDING_NOT_RUNNING = 1;
    private static $PENDING_RUNNING = 1;
    private static $PENDING_CRITICAL = 2;
    
    /**
    * Interface: 
    * Checks if a Job with specified jobType and params can be executed.
    * 
    * Implementation: 
    * Searches in $params for the Key UUID and looks up the VirtualServers for a representative Entity.
    * If such an Entity is found it checks if it is pending and returns false if it is pending.
    * 
    * In this implementation the value of $jobType is not used.
    * 
    * @param string $jobType
    * @param array $params
    * @return boolean
    */
    public function canBeExecuted($jobType, $params){
        // Es macht bei OVZ nur Sinn zu prüfen, ob der Job ausführbar ist, wenn es ein UUID in den Params gesetzt hat
        if($jobType!='ovz_new_vs' && is_array($params) && key_exists('UUID',$params)){
            $virtualServer = VirtualServers::findFirst("ovz_uuid ='".$params['UUID']."'");
            if($virtualServer->getPending() > 0){
                return false;
            }
        }
        return true;
    }
    
    /**
    * Interface: 
    * What should be done before the effective push is initiated.
    * 
    * Implementation:
    * Set pending to 1 of the representative VirtualServers if key 'UUID' exists in $params.
    * 
    * @param string $jobType
    * @param array $params
    */
    public function doBeforePush($jobType, $params){
        $this->updatePendingOnVirtualServer($jobType,1,$params);
        return;
    }
    
    /**
    * Interface:
    * What should be done after the push has finished.
    * 
    * Implementation:
    * Dependent on value of $done pending of the representative VirtualServers is set if key 'UUID' exists in $params.
    * 
    * @param string $jobType
    * @param array $params
    * @param int $done
    */
    public function doAfterPush($jobType, $params, $done){
        $pending = 1;
        switch(intval($done)){
            case OvzPendingSideEffect::$DONE_RUNNING:
                $pending = OvzPendingSideEffect::$PENDING_RUNNING;
                break;                 
            case OvzPendingSideEffect::$DONE_NOT_STARTED:
                $pending = OvzPendingSideEffect::$PENDING_RUNNING;
                break;                 
            case OvzPendingSideEffect::$DONE_SUCCESSFULL:
                $pending = OvzPendingSideEffect::$PENDING_NOT_RUNNING;
                break;                 
            case OvzPendingSideEffect::$DONE_FAILED:
                $pending = OvzPendingSideEffect::$PENDING_NOT_RUNNING;
                break;                 
            case OvzPendingSideEffect::$DONE_CRITICAL:
                $pending = OvzPendingSideEffect::$PENDING_CRITICAL;
                break;                     
            default:
                $pending = 1;
                break;
        }
        $this->updatePendingOnVirtualServer($jobType, $pending,$params);
        return;
    }
    
    private function updatePendingOnVirtualServer($jobType, $pending, $params){
        if($jobType!='ovz_new_vs' && is_array($params) && key_exists('UUID',$params)){
            $virtualServer = VirtualServers::findFirst("ovz_uuid ='".$params['UUID']."'");    
            $virtualServer->setPending(intval($pending));
            $virtualServer->save();
        }
    }
}
