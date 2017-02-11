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

use Phalcon\Validation;
use Phalcon\Validation\Validator\StringLength as StringLengthValitator;
use Phalcon\Validation\Validator\Regex as RegexValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\Confirmation as ConfirmationValidator;
use Phalcon\Mvc\Model\Behavior\Timestampable;

class VirtualServers extends \RNTForest\ovz\models\VirtualServersBase
{
    /**
    * Initialize method for model.
    */
    public function initialize()
    {
        parent::initialize();
        
        $this->belongsTo("customers_id",'RNTForest\OVZCP\models\Customers',"id",array("alias"=>"Customers", "foreignKey"=>true));
        $this->belongsTo("physical_servers_id",'RNTForest\OVZCP\models\PhysicalServers',"id",array("alias"=>"PhysicalServers", "foreignKey"=>true));
        $this->hasMany("id",'RNTForest\OVZCP\models\Dcoipobjects',"virtual_servers_id",array("alias"=>"Dcoipobjects", "foreignKey"=>array("allowNulls"=>true)));
        $this->hasMany("id",'RNTForest\OVZCP\models\Jobs',"virtual_servers_id",array("alias"=>"Jobs", "foreignKey"=>array("allowNulls"=>true)));
    }
    
}
