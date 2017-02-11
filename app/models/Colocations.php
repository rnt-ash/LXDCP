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

class Colocations extends \RNTForest\ovz\models\ColocationsBase
{
    
    /**
    * Initialize method for model.
    */
    public function initialize()
    {
        parent::initialize();
        
        $this->belongsTo("customers_id",'RNTForest\OVZCP\models\Customers',"id",array("alias"=>"Customers", "foreignKey"=>true));
        $this->hasMany("id",'RNTForest\OVZCP\models\PhysicalServers',"colocations_id",array("alias"=>"Customers", "foreignKey"=>array("allowNulls"=>true)));
        $this->hasMany("id",'RNTForest\OVZCP\models\Dcoipobjects',"colocations_id",array("alias"=>"Customers", "foreignKey"=>array("allowNulls"=>true)));
    }
}
