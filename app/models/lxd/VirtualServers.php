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

namespace RNTForest\lxd\models;

use RNTForest\bil\interfaces\BilPeriodicInterface;

/**
* @property \RNTForest\core\models\Customers $Customer
* @property \RNTForest\lxd\models\VirtualServers $VirtualServer
* @property \RNTForest\hws\models\HostingUsers $MainUser
* 
*/
class VirtualServers extends VirtualServersBase
{
    /**
    * Initialize method for model.
    */
    public function initialize()
    {
        parent::initialize();
        $this->hasOne("id",'RNTForest\hws\models\VirtualServersHws',"virtual_servers_id",array("alias"=>"VirtualServersHws", "foreignKey"=>true));
    }
}
