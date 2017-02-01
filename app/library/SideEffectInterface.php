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

interface SideEffectInterface
{
    /**
    * Checks if a Job with specified jobType and params can be executed.
    * 
    * @param string $jobType
    * @param array $params
    * @return boolean
    */
    public function canBeExecuted($jobType, $params);
    
    /**
    * What should be done before the effective push is initiated.
    * 
    * @param string $jobType
    * @param array $params
    */
    public function doBeforePush($jobType, $params);
    
    /**
    * What should be done after the push has finished.
    * 
    * @param string $jobType
    * @param array $params
    * @param int $done
    */
    public function doAfterPush($jobType, $params, $done);
}
