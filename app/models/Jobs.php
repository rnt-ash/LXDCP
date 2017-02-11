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

namespace RNTForest\OVZCP\models;

use Phalcon\Mvc\Model\Behavior\Timestampable;

class Jobs extends \RNTForest\core\models\JobsBase
{
    /**
    * Initialize method for model.
    */
    public function initialize()
    {
        parent::initialize();
        
        $this->belongsTo("logins_id",'RNTForest\OVZCP\models\Logins',"id",array("alias" => "Logins","foreignKey"=>true));
        $this->belongsTo("physical_servers_id",'RNTForest\OVZCP\models\PhysicalServers',"id",array("alias" => "PhysicalServers","foreignKey"=>array("allowNulls"=>true)));
        $this->belongsTo("virtual_servers_id",'RNTForest\OVZCP\models\VirtualServers',"id",array("alias" => "VirtualServers","foreignKey"=>array("allowNulls"=>true)));
    }
}
