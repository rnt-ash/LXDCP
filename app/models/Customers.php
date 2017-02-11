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
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Mvc\Model\Message as Message;

class Customers extends \RNTForest\core\models\CustomersBase
{
    /**
    * Initialize method for model.
    */
    public function initialize()
    {
        parent::initialize();
        
        // set relations
        $this->hasMany("id",'RNTForest\OVZCP\models\Logins',"customers_id",array("alias"=>"Logins", "foreignKey"=>true));
        $this->hasManyToMany("id",'RNTForest\OVZCP\models\CustomersPartners',"customers_id","partners_id",'RNTForest\core\models\Customers',"id",array("alias"=>"Partners"));
        $this->hasMany("id",'RNTForest\OVZCP\models\Colocations',"customers_id",array("alias"=>"Colocations", "foreignKey"=>true));
        $this->hasMany("id",'RNTForest\OVZCP\models\PhysicalServers',"customers_id",array("alias"=>"PhysicalServers", "foreignKey"=>true));
        $this->hasMany("id",'RNTForest\OVZCP\models\VirtualServers',"customers_id",array("alias"=>"VirtualServers", "foreignKey"=>true));
    }
}
