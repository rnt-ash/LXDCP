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

class CustomersPartners extends \RNTForest\core\models\CustomersPartnersBase
{
    public function initialize()
    {
        parent::initialize();
        
        $this->belongsTo("customers_id",'RNTForest\OVZCP\models\Customers',"id",array("alias" => "Customer",));
        $this->belongsTo("partners_id",'RNTForest\OVZCP\models\Customers',"id",array("alias" => "Partner",));
    }
}
?>
