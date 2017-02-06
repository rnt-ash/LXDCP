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

use Phalcon\Events\Event,
    Phalcon\Mvc\User\Plugin,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Acl,
    Phalcon\DI\FactoryDefault as PhDi;

/**
* ACL for the application
*/

class Security extends Plugin
{

    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {

        $di = PhDi::getDefault();

        // global config
        $config = $di['config'];

        // Take the active controller/action from the dispatcher
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();
        
        // No ACL checks for Access- and ErrorsController
        if ( $controller == 'access' || $controller == 'errors') {
            return true;
        }

        // Check whether the "auth" variable exists in session to define the active role
        $auth = $this->session->get('auth');
        
        if($controller == 'periodic' && $action == 'push'){
            // workaround to run pusher without beeing authenticated (cronjob with curl at the moment)
            $role = 'admin';
        }
        elseif ( !$auth ) {
            // user not logged in
            $dispatcher->forward(
                array(
                    'controller' => 'access',
                    'action' => 'login'
                )
            );
            return false;
        } else {
            $role = $auth['role'];
        }

        // Obtain the ACL list
        $acl = $this->getAcl();

        if($config->application->mode == 'production'){
            // Check whether acl data already exist
            $aclFileName = $config->application['securityDir'] . "acl.data";
            if ( !is_file($aclFileName) ) {

                // Obtain the ACL list
                $acl = $this->getAcl();

                // Store serialized list into plain file
                file_put_contents($aclFileName, serialize($acl));

            } else {

                //Restore acl object from serialized file
                $acl = unserialize(file_get_contents($aclFileName));
            }
        }
        
        // Check if the role have access to the controller (resource)
        $allowed = $acl->isAllowed($role, $controller, $action);

        if ( $allowed != Acl::ALLOW ) {

            // If user doesn't have access forward to the index controller
            $this->flashSession->warning("You don't have access to this module.");
            $dispatcher->forward(
                array(
                    'controller' => 'errors',
                    'action' => 'show401'
                )
            );
            
            // Returning "false" will tell to the dispatcher to stop the current operation
            return false;
        }
    }

    public function getAcl()
    {

        // Create the ACL
        $acl = new Phalcon\Acl\Adapter\Memory();

        // The default action is DENY access
        $acl->setDefaultAction(Phalcon\Acl::DENY);

        // Register roles
        $roles = array(
            'admin'   => new Phalcon\Acl\Role('admin'),
            'user'    => new Phalcon\Acl\Role('user'),
            'public'  => new Phalcon\Acl\Role('public'),
        );
        
        // Adding Roles to the ACL
        foreach ($roles as $role) {
            $acl->addRole($role);
        }

        // Adding Resources (controllers/actions)
        // resources allowed for all groups
        $publicResources = array(
            'index'     => array('index'),
            'periodic'  => array('push'),
        );

        $privateResources = array(
            'index'             => array('faker', 'toggleSidebar', 'scanAllVS' ),
            'colocations'       => array('index', 'search', 'create', 'new', 'edit', 
                                            'addIpObject', 'editIpObject', 'deleteIpObject',
                                            'save', 'delete', 'tabledata', 'slidedata', 'slideSlide'),
            'customers'         => array('index', 'new', 'edit', 'save', 'delete', 'tabledata'),
            'dcoipobjects'      => array('edit', 'save', 'cancel', 'delete', 'makeMain'),
            'jobs'              => array('index', 'delete', 'updateJobs'),
            'logins'            => array('index', 'new', 'edit', 'save', 'delete', 'profile', 'tabledata', 
                                            'saveBootswatchTheme', 'resetPasswordForm', 'resetPassword'),
            'physical_servers'  => array('index', 'new', 'edit', 'save', 'delete', 
                                            'addIpObject', 'editIpObject', 'deleteIpObject',
                                            'slidedata', 'slideSlide', 'ovzHostInfo', 'connectForm', 'connect'),
            'virtual_servers'   => array('index', 'newVS', 'newCT', 'newVM', 'edit', 
                                            'startVS', 'stopVS', 'restartVS', 
                                            'addIpObject', 'editIpObject', 'deleteIpObject', 'makeMainIpObject', 
                                            'save', 'delete', 'slidedata', 'slideSlide', 'ovzListInfo', 
                                            'ovzListSnapshots', 'ovzCreateSnapshot', 'ovzDeleteSnapshot', 
                                            'ovzSwitchSnapshot', 'snapshotForm'),
        );
        
        foreach ($publicResources as $resource => $actions) {
            $acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
        }

        foreach ($privateResources as $resource => $actions) {
            $acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
        }

        // Defining Access Controls
        // Grant access to public areas to all roles
        foreach ($roles as $role) {
            foreach ($publicResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow($role->getName(), $resource, $action);
                }
            }
        }

        // Grant access to private area only to certain roles
        foreach ($privateResources as $resource => $actions) {
            foreach ($actions as $action) {
                $acl->allow($roles['admin']->getName(), $resource, $action);
                $acl->allow($roles['user']->getName(), $resource, $action);
            }
        }

        return $acl;
    }

}