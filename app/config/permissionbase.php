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
                        'index', 'search', 'create', 'new', 'edit', 'form',
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
                        'index', 'new', 'edit', 'form', 'save', 'delete', 'tabledata', 'tableDetail' 
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
                        'index', 'new', 'edit', 'form', 'save', 'delete', 'tabledata'
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
                        'index', 'new', 'delete', 'tabledata', 'tableDetail' ,
                        'getPDF', 'sendPDF'
                    ]
                ],
            ],
            'profile' => [
                'description' => 'Profile access', 
                'scopes' => [
                    '1' => "Access to all profiles", 
                    'own' => "Access to owners profile", 
                    '0' => "Access to no profiles", 
                ],
                'functions' => array(
                    'own' => '\RNTForest\OVZCP\libraries\PermissionFunctions::own',
                ),
                'actions' => [
                    'logins' => [
                        'profile', 'edit', 'save', 'form',
                        'saveBootswatchTheme', 'resetPasswordForm', 'resetPassword',
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
                        'index', 'new', 'edit', 'form', 'save', 'delete', 
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
                'functions' => array(
                    'partners' => '\RNTForest\OVZCP\libraries\PermissionFunctions::partners',
                    'customers' =>'\RNTForest\OVZCP\libraries\PermissionFunctions::customers',
                ),
                'actions' => [
                    'virtual_servers' => [
                        'index', 
                        'addIpObject', 'editIpObject', 'deleteIpObject', 'makeMainIpObject', 
                        'save', 'slidedata', 'slideSlide', 'ovzListInfo', 
                        'ovzListSnapshots', 'ovzCreateSnapshot', 'ovzDeleteSnapshot', 
                        'ovzSwitchSnapshot', 'snapshotForm'                
                    ]
                ],
            ],
            // new permission
            'new' => [
                'description' => 'create a virtual servers', 
                'scopes' => [
                    '1' => "Create on all physical servers", 
                    'partners' => "Create virtual servers on partners and own physical servers only", 
                    'customers' => "Create virtual servers on own physical servers only", 
                    '0' => "Create no virtual servers", 
                ],
                'functions' => array(
                    'partners' => '\RNTForest\OVZCP\libraries\PermissionFunctions::partners',
                    'customers' =>'\RNTForest\OVZCP\libraries\PermissionFunctions::customers',
                ),
                'actions' => [
                    'virtual_servers' => [
                        'new', 'newVS', 'newCT', 'newVM',
                    ]
                ],
            ],
            // delete permission
            'delete' => [
                'description' => 'delete virtual servers', 
                'scopes' => [
                    '1' => "delete all virtual servers", 
                    'partners' => "delete virtual servers from partners and own only", 
                    'customers' => "delete own virtual servers only", 
                    '0' => "delete no virtual servers", 
                ],
                'functions' => array(
                    'partners' => '\RNTForest\OVZCP\libraries\PermissionFunctions::partners',
                    'customers' =>'\RNTForest\OVZCP\libraries\PermissionFunctions::customers',
                ),
                'actions' => [
                    'virtual_servers' => [
                        'delete',
                    ]
                ],
            ],
            // edit permission
            'edit' => [
                'description' => 'edit a virtual servers', 
                'scopes' => [
                    '1' => "edit all virtual servers", 
                    'partners' => "edit virtual servers from partners and own only", 
                    'customers' => "edit own virtual servers only", 
                    '0' => "edit no virtual servers", 
                ],
                'functions' => array(
                    'partners' => '\RNTForest\OVZCP\libraries\PermissionFunctions::partners',
                    'customers' =>'\RNTForest\OVZCP\libraries\PermissionFunctions::customers',
                ),
                'actions' => [
                    'virtual_servers' => [
                        'edit', 'form',
                    ]
                ],
            ],
            // configure permission
            'configure' => [
                'description' => 'configure a virtual servers', 
                'scopes' => [
                    '1' => "configure all virtual servers", 
                    'partners' => "configure virtual servers from partners and own only", 
                    'customers' => "configure own virtual servers only", 
                    '0' => "configure no virtual servers", 
                ],
                'functions' => array(
                    'partners' => '\RNTForest\OVZCP\libraries\PermissionFunctions::partners',
                    'customers' =>'\RNTForest\OVZCP\libraries\PermissionFunctions::customers',
                ),
                'actions' => [
                    'virtual_servers' => [
                        'configureVirtualServers', 'configureVirtualServersForm', 'sendConfigureVirtualServers'
                    ]
                ],
            ],
            // save permission
            'save' => [
                'description' => 'save a virtual servers', 
                'scopes' => [
                    '1' => "save all virtual servers", 
                    'partners' => "save virtual servers from partners and own only", 
                    'customers' => "save own virtual servers only", 
                    '0' => "save no virtual servers", 
                ],
                'functions' => array(
                    'partners' => '\RNTForest\OVZCP\libraries\PermissionFunctions::partners',
                    'customers' =>'\RNTForest\OVZCP\libraries\PermissionFunctions::customers',
                ),
                'actions' => [
                    'virtual_servers' => [
                        'save',
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
                'functions' => array(
                    'partners' => '\RNTForest\OVZCP\libraries\PermissionFunctions::partners',
                    'customers' =>'\RNTForest\OVZCP\libraries\PermissionFunctions::customers',
                ),
                'actions' => [
                    'virtual_servers' => [
                        'startVS', 'stopVS', 'restartVS', 
                    ]
                ],
            ],
        ],
    ]
]);
