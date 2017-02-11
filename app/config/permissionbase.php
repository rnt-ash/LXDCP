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
        'index' => [
            'general' => [
                'description' => 'General access', 
                'scopes' => [
                    '1' => "Show all",
                    '0' => "Show nothing",
                ],
                'actions' => [
                    'index' => [
                        'index', 'toggleSidebar', 'scanAllVS'
                    ]
                ],
            ],
        ],
        'colocations' => [
            'general' => [
                'description' => 'General access', 
                'scopes' => [
                    '1' => "Show all colocations", 
                    'partners' => "Show colocations from partners and own only", 
                    'customers' => "Show own colocations only", 
                    '0' => "Show no colocations", 
                ],
                'actions' => [
                    'colocations' => [
                        'index', 'search', 'create', 'new', 'edit', 
                        'addIpObject', 'editIpObject', 'deleteIpObject',
                        'save', 'delete', 'tabledata', 'slidedata', 'slideSlide'                
                    ]
                ],
            ],
        ],
        'customers' => [
            'general' => [
                'description' => 'General access', 
                'scopes' => [
                    '1' => "Show all customers", 
                    'partners' => "Show customers where login is partner only", 
                    '0' => "Show no customers", 
                ],
                'actions' => [
                    'customers' => [
                        'index', 'new', 'edit', 'save', 'delete', 'tabledata', 'tableDetail' 
                    ]
                ],
            ],
        ],
        'dcoipobjects' => [
            'general' => [
                'description' => 'General access', 
                'scopes' => [
                    '1' => "Show all dcoipobjects", 
                    '0' => "Show no dcoipobjects", 
                ],
                'actions' => [
                    'dcoipobjects' => [
                        'index', 'new', 'edit', 'save', 'delete', 'tabledata'
                    ]
                ],
            ],
        ],
        'jobs' => [
            'general' => [
                'description' => 'General access', 
                'scopes' => [
                    '1' => "Show all jobs", 
                    '0' => "Show no jobs", 
                ],
                'actions' => [
                    'jobs' => [
                        'index', 'delete', 'updateJobs'
                    ]
                ],
            ],
        ],
        'logins' => [
            'general' => [
                'description' => 'General access', 
                'scopes' => [
                    '1' => "Show all logins", 
                    '0' => "Show no logins", 
                ],
                'actions' => [
                    'logins' => [
                        'index', 'new', 'edit', 'save', 'delete', 'profile', 'tabledata', 'tableDetail' ,
                        'saveBootswatchTheme', 'resetPasswordForm', 'resetPassword', 'getPDF', 'sendPDF'
                    ]
                ],
            ],
        ],
        'physical_servers' => [
            'general' => [
                'description' => 'General access', 
                'scopes' => [
                    '1' => "Show all physical servers", 
                    'partners' => "Show physical servers from partners and own only", 
                    'customers' => "Show own physical servers only", 
                    '0' => "Show no physical servers", 
                ],
                'actions' => [
                    'physical_servers' => [
                        'index', 'new', 'edit', 'save', 'delete', 
                        'addIpObject', 'editIpObject', 'deleteIpObject',
                        'slidedata', 'slideSlide', 'ovzHostInfo', 'connectForm', 'connect'                
                    ]
                ],
            ],
        ],
        'virtual_servers' => [
            // general permission
            'general' => [
                'description' => 'General access', 
                'scopes' => [
                    '1' => "Show all virtual servers", 
                    'partners' => "Show virtual servers from partners and own only", 
                    'customers' => "Show own virtual servers only", 
                    '0' => "Show no virtual servers", 
                ],
                'functions' => $vsfunctions = array(
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
                        'index', 'edit', 
                        'addIpObject', 'editIpObject', 'deleteIpObject', 'makeMainIpObject', 
                        'save', 'slidedata', 'slideSlide', 'ovzListInfo', 
                        'ovzListSnapshots', 'ovzCreateSnapshot', 'ovzDeleteSnapshot', 
                        'ovzSwitchSnapshot', 'snapshotForm'                
                    ]
                ],
            ],
            // create and delete permission
            'createdelete' => [
                'description' => 'create an delete virtual servers', 
                'scopes' => [
                    '1' => "Create/delete all virtual servers", 
                    'partners' => "Create/delete virtual servers from partners and own only", 
                    'customers' => "Create/delete own virtual servers only", 
                    '0' => "Create/delete no virtual servers", 
                ],
                'functions' => $vsfunctions,
                'actions' => [
                    'virtual_servers' => [
                        'newVS', 'newCT', 'newVM', 'delete',
                    ]
                ],
            ],
            // change state permission
            'changestate' => [
                'description' => 'change the state of a virtual servers (start, stop, restart)', 
                'scopes' => [
                    '1' => "Change state on all virtual servers", 
                    'partners' => "Change state on virtual servers from partners and own only", 
                    'customers' => "Change state on own virtual servers only", 
                    '0' => "Change state on no virtual servers", 
                ],
                'functions' => $vsfunctions,
                'actions' => [
                    'virtual_servers' => [
                        'startVS', 'stopVS', 'restartVS', 
                    ]
                ],
            ],
        ],
    ]
]);
