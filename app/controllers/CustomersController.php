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

use Phalcon\Mvc\Model\Criteria;

class CustomersController extends TableSlideBase
{
    protected function getTableDataInfo() {
        return array(
            "controller" => "customers",
            "action" => "index",
            "scope" => "",
            "order" => "name",
            "orderdir" => "asc",
            "filters" => array(),
            "page" => 1,
            "limit" => 10,
            "columns" => array(
                "name"=>array(
                    "title"=>"Name",
                    "show"=>true,
                    "pos"=>2,
                    "width"=>200,
                ),
                "company"=>array(
                    "title"=>"Firma",
                    "show"=>true,
                    "pos"=>4,
                    "width"=>200,
                ),
                "city"=>array(
                    "title"=>"Ort",
                    "show"=>true,
                    "pos"=>5,
                    "width"=>150,
                ),
            ),
        );
    }

    protected function filterTableItems($items){
        // Alle Filter abholen
        if($this->request->has('filterAll')){
            $oldfilter = $this->tableDataInfo['filters']['filterAll'];
            $this->tableDataInfo['filters']['filterAll'] = $this->request->get("filterAll", "string");
            if($oldfilter != $this->tableDataInfo['filters']['filterAll']) $this->tableDataInfo['page'] = 1;
        }

        // Filter anwenden        
        if(!empty($this->tableDataInfo['filters']['filterAll'])){ 
            $items = $items->filter(
                function($item){
                    $ok = false;
                    foreach($this->tableDataInfo['columns'] as $key => $column){
                        if(strpos(strtolower($item->printTableData($key)),strtolower($this->tableDataInfo['filters']['filterAll']))!==false) $ok = true;
                    }
                    if($ok) return $item;
                }
            );
        }
        return $items; 

        // Filter auswerten        
        $filter = $this->tableDataInfo['filter'];  
        $ok = false;
        if(empty($filter)){ 
            $ok = true;
        } else {
            foreach($this->tableDataInfo['columns'] as $key => $column){
                if(strpos(strtolower($aItem[$key]),strtolower($filter))!==false) $ok = true;
            }
        }
        return $items;
    }

}
