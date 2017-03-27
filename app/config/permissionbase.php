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
                        'index', 'toggleSidebar',
                    ],
                    'logins' => [
                        'editProfile', 'formProfile', 'updateProfile', 'profile', 'saveBootswatchTheme', 'resetPasswordForm', 'resetPassword',
                    ]
                ],
            ],
        ],
        'administration' => [
            'general' => [
                'description' => 'Administration access', 
                'scopes' => [
                    '1' => "Show all",
                    '0' => "Show nothing",
                ],
                'actions' => [
                    'administration' => [
                        'index', 'scanAllVS', 'genPermissionsPDF', 'genOVZJobsPDF', 'genActionsPDF', 'deployRootKeys',
                        'faker', 'fakeCustomers', 'fakeLogins', 'fakeColocations', 'fakePhysicalServers', 
                        'fakeVirtualServers', 'fakePartners',
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
                        'ipObjectAdd', 'ipObjectEdit', 'ipObjectDelete', 'ipObjectMakeMain',
                        'save', 'delete', 'tabledata', 'slidedata', 'slideSlide', 'generateIpPdf'                
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
        'partners' => [
            'general' => [
                'description' => 'General access', 
                'scopes' => [
                    '1' => "Show all partners", 
                    'customers' => "Show only own partners and customers where customer is partner", 
                    'partners' => "Show only own partners and customers where customer is partner", 
                    '0' => "Show no customers", 
                ],
                'actions' => [
                    'partners' => [
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
                        'index', 'new', 'edit', 'form', 'save', 'delete', 'cancel', 'tabledata', 'makeMain'
                    ]
                ],
            ],
        ],
        'jobs' => [
            // general permission
            'general' => [
                'description' => 'General access', 
                'scopes' => [
                    '1' => "Show all jobs", 
                    'customers' => "Show Jobs from my customer logins only", 
                    '0' => "Show no jobs", 
                ],
                'functions' => [],
                'actions' => [
                    'jobs' => [
                        'index', 'delete', 'updateJobs'
                    ]
                ],
            ],
        ],
        'logins' => [
            // general permission
            'general' => [
                'description' => 'General access', 
                'scopes' => [
                    '1' => "Show all logins", 
                    '0' => "Show no logins", 
                ],
                'functions' => [],
                'actions' => [
                    'logins' => [
                        'index', 'new', 'delete', 'edit', 'form', 'save', 'tabledata', 'tableDetail',
                        'getPDF', 'sendPDF'
                    ]
                ],
            ],
        ],
        'physical_servers' => [
            // general permission
            'general' => [
                'description' => 'General access', 
                'scopes' => [
                    '1' => "Show all physical servers", 
                    'partners' => "Show physical servers from partners and own only", 
                    'customers' => "Show own physical servers only", 
                    '0' => "Show no physical servers", 
                ],
                'functions' => array(
                    'partners' => '\RNTForest\OVZCP\libraries\PermissionFunctions::partners',
                    'customers' =>'\RNTForest\OVZCP\libraries\PermissionFunctions::customers',
                ),
                'actions' => [
                    'physical_servers' => [
                        'index', 'new', 'edit', 'form', 'save', 'delete', 
                        'ipObjectAdd', 'ipObjectEdit', 'ipObjectDelete', 'ipObjectMakeMain',
                        'slidedata', 'slideSlide', 'ovzHostInfo', 'ovzHostStatisticsInfo', 'ovzConnector', 'ovzConnectorExecute'                
                    ]
                ],
            ],
            // filter by customers
            'filter_customers' => [
                'description' => 'Filter Physical Servers by customers', 
                'scopes' => [
                    '1' => "Filter for Physical Servers by all customers", 
                    'partners' => "Filter for Physical Servers by all customers where this login is partner", 
                    '0' => "Filter not allowed", 
                ],
                'functions' => [],
                'actions' => [],
            ],
            // filter by colocations
            'filter_colocations' => [
                'description' => 'Filter Physical Servers by Colocations', 
                'scopes' => [
                    '1' => "Filter by all Colocations", 
                    'partners' => "Filter by all Colocations where this login is partner", 
                    'customers' => "Filter by all my Colocations", 
                    '0' => "Filter not allowed", 
                ],
                'functions' => [],
                'actions' => [],
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
                'functions' => [],
                'actions' => [
                    'virtual_servers' => [
                        'index', 
                        'ipObjectAdd', 'ipObjectEdit', 'ipObjectDelete', 'ipObjectMakeMain',
                        'save', 'slidedata', 'slideSlide', 'ovzUpdateInfo', 
                    ]
                ],
            ],
            // filter by customers
            'filter_customers' => [
                'description' => 'Filter Virtual Servers by all customers', 
                'scopes' => [
                    '1' => "Filter for Virtual Servers by customers", 
                    'partners' => "Filter for Virtual Servers by all customers where this login is partner", 
                    '0' => "Filter not allowed", 
                ],
                'functions' => [],
                'actions' => [],
            ],
            // filter by physical Servers
            'filter_physical_servers' => [
                'description' => 'Filter Virtual Servers by Physical Servers', 
                'scopes' => [
                    '1' => "Filter by all Physical Servers", 
                    'partners' => "Filter by all Physical Servers where this login is partner", 
                    'customers' => "Filter by all my Physical Servers", 
                    '0' => "Filter not allowed", 
                ],
                'functions' => [],
                'actions' => [],
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
                        'virtualServersConfigure', 'virtualServersConfigureForm', 'virtualServersConfigureSend'
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
            // snapshot permissions
            'snapshots' => [
                'description' => 'Create, switch an delete (manage) snapshots', 
                'scopes' => [
                    '1' => "Manage snapshots for all virtual servers", 
                    'partners' => "Manage snapshots for virtual servers from partners and own only", 
                    'customers' => "Manage snapshots for own virtual servers only", 
                    '0' => "Manage snapshots for no virtual servers", 
                ],
                'functions' => array(
                    'partners' => '\RNTForest\OVZCP\libraries\PermissionFunctions::partners',
                    'customers' =>'\RNTForest\OVZCP\libraries\PermissionFunctions::customers',
                ),
                'actions' => [
                    'virtual_servers' => [
                        'ovzSnapshotList', 'ovzSnapshotSwitch', 'ovzSnapshotCreate', 'ovzSnapshotCreateExecute',
                        'ovzSnapshotDelete',
                    ]
                ],
            ],
            // replica permissions
            'replicas' => [
                'description' => 'activate, run an delete (manage) replicas', 
                'scopes' => [
                    '1' => "Manage replicas for all virtual servers", 
                    'partners' => "Manage replicas for virtual servers from partners and own only", 
                    'customers' => "Manage replicas for own virtual servers only", 
                    '0' => "Manage replicas for no virtual servers", 
                ],
                'functions' => array(
                    'partners' => '\RNTForest\OVZCP\libraries\PermissionFunctions::partners',
                    'customers' =>'\RNTForest\OVZCP\libraries\PermissionFunctions::customers',
                ),
                'actions' => [
                    'virtual_servers' => [
                        'ovzReplicaActivate', 'ovzReplicaActivateExecute',
                        'ovzReplicaRun', 'ovzReplicaFailover', 'ovzReplicaDelete'
                    ]
                ],
            ],
            // modify permission
            'modify' => [
                'description' => 'modify a virtual servers', 
                'scopes' => [
                    '1' => "modify all virtual servers", 
                    'partners' => "modify virtual servers from partners and own only", 
                    'customers' => "modify own virtual servers only", 
                    '0' => "modify no virtual servers", 
                ],
                'functions' => array(
                    'partners' => '\RNTForest\OVZCP\libraries\PermissionFunctions::partners',
                    'customers' =>'\RNTForest\OVZCP\libraries\PermissionFunctions::customers',
                ),
                'actions' => [
                    'virtual_servers' => [
                        'virtualServerModifyExecute', 'virtualServerModify',
                    ]
                ],
            ],
            // change root password permission
            'change_root_password' => [
                'description' => 'set a new root password for a virtual server', 
                'scopes' => [
                    '1' => "set everywhere a new password",
                    'partners' => "set a new password from partners and own virtual servers only", 
                    'customers' => "set a new password for own virtual servers only", 
                    '0' => "set nowhere a new password", 
                ],
                'functions' => array(
                    'partners' => '\RNTForest\OVZCP\libraries\PermissionFunctions::partners',
                    'customers' =>'\RNTForest\OVZCP\libraries\PermissionFunctions::customers',
                ),
                'actions' => [
                    'virtual_servers' => [
                        'rootPasswordChange', 'rootPasswordChangeExecute',
                    ]
                ],
            ],
        ],
    ]
]);
