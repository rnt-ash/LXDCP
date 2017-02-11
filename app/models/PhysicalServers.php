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
use Phalcon\Mvc\Model\Behavior\Timestampable;

class PhysicalServers extends \RNTForest\ovz\models\PhysicalServersBase
{
    /**
    * Initialize method for model.
    */
    public function initialize()
    {
        parent::initialize();
        
        $this->belongsTo("customers_id",'RNTForest\OVZCP\models\Customers',"id",array("alias"=>"Customers", "foreignKey"=>true));
        $this->belongsTo("colocations_id",'RNTForest\OVZCP\models\Colocations',"id",array("alias"=>"Colocations", "foreignKey"=>true));
        $this->hasMany("id",'RNTForest\OVZCP\models\VirtualServers',"physical_servers_id",array("alias"=>"VirtualServers", "foreignKey"=>array("allowNulls"=>true)));
        $this->hasMany("id",'RNTForest\OVZCP\models\Dcoipobjects',"physical_servers_id",array("alias"=>"Dcoipobjects", "foreignKey"=>array("allowNulls"=>true)));
        $this->hasMany("id",'RNTForest\OVZCP\models\Jobs',"physical_servers_id",array("alias"=>"Jobs", "foreignKey"=>array("allowNulls"=>true)));
    }
}
