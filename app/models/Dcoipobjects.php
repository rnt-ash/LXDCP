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
use Phalcon\Validation\Validator\Between as BetweenValidator;
use Phalcon\Mvc\Model\Message as Message;

class Dcoipobjects extends \RNTForest\ovz\models\DcoipobjectsBase
{
    /**
    * Initialize method for model.
    */
    public function initialize()
    {
        parent::initialize();
        
        $this->belongsTo("colocations_id",'RNTForest\OVZCP\models\Colocations',"id",array("alias"=>"Colocations", "foreignKey"=>array("allowNulls"=>true)));
        $this->belongsTo("physical_servers_id",'RNTForest\OVZCP\models\PhysicalServers',"id",array("alias"=>"PhysicalServers", "foreignKey"=>array("allowNulls"=>true)));
        $this->belongsTo("virtual_servers_id",'RNTForest\OVZCP\models\VirtualServers',"id",array("alias"=>"VirtualServers", "foreignKey"=>array("allowNulls"=>true)));
    }
}
