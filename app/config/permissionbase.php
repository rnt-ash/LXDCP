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

return new \Phalcon\Config([
    'permissionbase' => [
        // Module, Name, Description, Scopes, Actions
        [
            'permissiongroup' => 'index',
            'name' => 'general', 
            'description' => 'General access', 
            'scopes' => [
                '*'
            ],
            'actions' => [
                'index' => [
                    'index', 'toggleSidebar', 'scanAllVS'
                ]
            ],
        ],
        [
            'permissiongroup' => 'colocations',
            'name' => 'general', 
            'description' => 'General access', 
            'scopes' => [
                '*', 'partners', 'customers'
            ],
            'actions' => [
                'colocations' => [
                    'index', 'search', 'create', 'new', 'edit', 
                    'addIpObject', 'editIpObject', 'deleteIpObject',
                    'save', 'delete', 'tabledata', 'slidedata', 'slideSlide'                
                ]
            ],
        ],
        [
            'permissiongroup' => 'customers',
            'name' => 'general', 
            'description' => 'General access', 
            'scopes' => [
                '*', 'partners'
            ],
            'actions' => [
                'customers' => [
                    'index', 'new', 'edit', 'save', 'delete', 'tabledata', 'tableDetail' 
                ]
            ],
        ],
        [
            'permissiongroup' => 'dcoipobjects',
            'name' => 'general', 
            'description' => 'General access', 
            'scopes' => [
                '*'
            ],
            'actions' => [
                'dcoipobjects' => [
                    'index', 'new', 'edit', 'save', 'delete', 'tabledata'
                ]
            ],
        ],
        [
            'permissiongroup' => 'jobs',
            'name' => 'general', 
            'description' => 'General access', 
            'scopes' => [
                '*'
            ],
            'actions' => [
                'jobs' => [
                    'index', 'delete', 'updateJobs'
                ]
            ],
        ],
        [
            'permissiongroup' => 'logins',
            'name' => 'general', 
            'description' => 'General access', 
            'scopes' => [
                '*'
            ],
            'actions' => [
                'logins' => [
                    'index', 'new', 'edit', 'save', 'delete', 'profile', 'tabledata', 'tableDetail' ,
                    'saveBootswatchTheme', 'resetPasswordForm', 'resetPassword', 'getPDF', 'sendPDF'
                ]
            ],
        ],
        [
            'permissiongroup' => 'physical_servers',
            'name' => 'general', 
            'description' => 'General access', 
            'scopes' => [
                '*', 'partners', 'customers'
            ],
            'actions' => [
                'physical_servers' => [
                    'index', 'new', 'edit', 'save', 'delete', 
                    'addIpObject', 'editIpObject', 'deleteIpObject',
                    'slidedata', 'slideSlide', 'ovzHostInfo', 'connectForm', 'connect'                
                ]
            ],
        ],
        [
            'permissiongroup' => 'virtual_servers',
            'name' => 'general', 
            'description' => 'General access', 
            'scopes' => [
                '*', 'partners', 'customers'
            ],
            'functions' => array(
                'partners' => function (VirtualServers $virtualServer) {
                        $customers_id = $this->session->get('auth')['customers_id'];
                        return false;
                    },
                'customers' => function (VirtualServers $virtualServer) {
                        $customers_id = $this->session->get('auth')['customers_id'];
                        if($virtualServer->getCustomersId() == $customers_id)
                            return true;
                        else
                            return true;
                        
                    },
            ),
            'actions' => [
                'virtual_servers' => [
                    'index', 'newVS', 'newCT', 'newVM', 'edit', 
                    'startVS', 'stopVS', 'restartVS', 
                    'addIpObject', 'editIpObject', 'deleteIpObject', 'makeMainIpObject', 
                    'save', 'delete', 'slidedata', 'slideSlide', 'ovzListInfo', 
                    'ovzListSnapshots', 'ovzCreateSnapshot', 'ovzDeleteSnapshot', 
                    'ovzSwitchSnapshot', 'snapshotForm'                
                ]
            ],
        ],
    ]
]);
