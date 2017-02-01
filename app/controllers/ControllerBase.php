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

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\DispatcherInterface;
use Phalcon\DI\FactoryDefault as PhDi;

/**
* Basis Klasse für alle Kontroller
*/

class ControllerBase extends Controller
{
    public function initialize(){

        // global config
        $di = PhDi::getDefault();
        $config = $di['config'];

        // user name and bootswatch theme
        $userSession = $this->session->get('auth');
        if ( !empty($userSession) ) {
            $this->view->sessionLoginname = $userSession['loginname'];
            $this->view->sessionBootwatchTheme = $userSession['settings']['bootswatchTheme'];
            $this->view->sessionLoginId = $userSession['id'];
        }

        // default page title icon
        $this->view->pageTitleIcon = '<i class="fa-fw fa fa-home"></i>';

        // application name
        $this->view->appTitle = $config->application['appTitle'];

        // get sidebarToggled status from session
        if(!isset($this->session->sidebarToggled)){
            $this->session->sidebarToggled = $this->view->sidebarToggled = false;
        }else{
            $this->view->sidebarToggled = $this->session->sidebarToggled;
        }
    }

    public function beforeExecuteRoute(DispatcherInterface $dispatcher)
    {
        // Executed before every found action
        $this->logger->debug("Action ".$dispatcher->getControllerName()."/".$dispatcher->getActionName()." called.");
    }    

    public function redirectTo($path){
        $this->response->redirect($path);
        $this->view->disable(); 
    }

    /**
    * dummy method only for auto completion purpose
    * 
    * @return Push
    */
    protected function getPushService(){
        return $this->di['push'];
    }
    
}    

