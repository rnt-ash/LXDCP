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
use Phalcon\Paginator\Adapter\Model as Paginator;


class LoginsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for logins
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Logins', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $logins = Logins::find($parameters);
        if (count($logins) == 0) {
            $this->flash->notice("The search did not find any logins");

            $this->dispatcher->forward([
                "controller" => "logins",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $logins,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a login
     *
     * @param string $id
     */
    public function editAction($item)
    {
        if(is_a($item,'LoginsForm')){
            // Get item from form
            $this->view->form = $item;
        } else {
            // Get item from Database
            $item = Logins::findFirstByid($item);
            if (!$item) {
                $this->flash->error("item was not found");
                $this->dispatcher->forward([
                    'controller' => 'logins',
                    'action' => 'profile'
                ]);

                return;
            }
            
            $this->view->form = new LoginsForm($item);
        }
    }

    /**
     * Creates a new login
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "logins",
                'action' => 'index'
            ]);

            return;
        }

        $login = new Logins();
        $login->setLoginname($this->request->getPost("loginname"));
        $login->setPassword($this->request->getPost("password"));
        $login->setCustomersId($this->request->getPost("customers_id"));
        $login->setAdmin($this->request->getPost("admin"));
        $login->setTitle($this->request->getPost("title"));
        $login->setLastname($this->request->getPost("lastname"));
        $login->setFirstname($this->request->getPost("firstname"));
        $login->setPhone($this->request->getPost("phone"));
        $login->setComment($this->request->getPost("comment"));
        $login->setEmail($this->request->getPost("email", "email"));
        $login->setActive($this->request->getPost("active"));
        

        if (!$login->save()) {
            foreach ($login->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "logins",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("login was created successfully");

        $this->dispatcher->forward([
            'controller' => "logins",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a login edited
     *
     */
    public function saveAction()
    {
        // POST request?
        if (!$this->request->isPost())
            return $this->redirectTo("logins/profile");

        // Edit or new Record
        $id = $this->request->getPost("id", "int");
        if(empty($id)){
            $item = new Logins;
        }else{
            $item = Logins::findFirstById($id);
            if (!$item) {
                $this->flashSession->error("Item does not exist");
                return $this->redirectTo("logins/profile");
            }
        }

        // validate FORM
        $form = new LoginsForm;
        
        $data = $this->request->getPost();
        if (!$form->isValid($data, $item)) {
            return $this->dispatcher->forward([
                'action' => 'edit',
                'params' => [$form],
            ]);
        }

        // save data
        if ($item->save() === false) {
            // fetch all messages from model
            foreach ($item->getMessages() as $message) {
                $form->appendMessage(new Phalcon\Validation\Message($message->getMessage(),$message->getField()));
            }
            return $this->dispatcher->forward([
                'action' => 'edit',
                'params' => [$form],
            ]);
        }
        
        // change loginname in session
        $_SESSION['auth']['loginname'] = $item->loginname;
        
        // clean up
        $form->clear();
        $this->flashSession->success("Item was updated successfully");
        return $this->redirectTo("logins/profile");
    }

    /**
     * Deletes a login
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $login = Logins::findFirstByid($id);
        if (!$login) {
            $this->flash->error("login was not found");

            $this->dispatcher->forward([
                'controller' => "logins",
                'action' => 'index'
            ]);

            return;
        }

        if (!$login->delete()) {

            foreach ($login->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "logins",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("login was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "logins",
            'action' => "index"
        ]);
    }

    /**
    * provides the informations for the profile
    * 
    */
    public function profileAction(){
        $this->view->login = Logins::findFirst($this->session->auth['id']);
        $this->view->login->customer = $this->view->login->customers->printAddressText();
        $this->view->login->bootswatchTheme = $this->session->auth['settings']['bootswatchTheme'];
    }
    
    /**
    * saves the chosen Bootswatch theme
    * 
    * @param mixed $theme
    */
    public function saveBootswatchThemeAction($theme = ''){
        $login = Logins::findFirstByid($this->session->auth['id']);
        
        $_SESSION['auth']['settings']['bootswatchTheme'] = strtolower($theme);
        
        $login->setSettings($this->session->auth['settings']);
        
        if (!$login->save()) {
            foreach ($login->getMessages() as $message) {
                $this->flash->error($message);
            }

            return;
        }
        
        $this->dispatcher->forward([
            'controller' => "logins",
            'action' => "profile"
        ]);
    }
    
    public function resetPasswordAction(){
        // POST request?
        if (!$this->request->isPost())
            return $this->redirectTo("logins/profile");

        // Edit or new Record
        $login = Logins::findFirstById($this->request->getPost("login_id", "int"));
        if (!$login) {
            $this->flashSession->error("Item does not exist");
            return $this->redirectTo("logins/profile");
        }
            
        // validate FORM
        $form = new ResetPasswordForm();
        $formFields = new ResetPasswordFormFields();
        $data = $this->request->getPost();
        if (!$form->isValid($data, $formFields)) {
            return $this->dispatcher->forward([
                'action' => 'resetPasswordForm',
                'params' => [$form],
            ]);
        }
        
        // check if the old password from form is the same as the one in the DB
        $oldPassword = hash('sha256', $this->config->application['securitySalt'] . $formFields->old_password);
        if($oldPassword == $login->getPassword()){
            $login->setPassword(hash('sha256', $this->config->application['securitySalt'] . $formFields->password));
        } else {
            $msg = new Phalcon\Validation\Message('old password is incorrect','old_password');
            $form->appendMessage($msg);
            return $this->dispatcher->forward([
                'action' => 'resetPasswordForm',
                'params' => [$form],
            ]);
        }
        
        // set new password
        $login->setPassword(hash('sha256', $this->config->application['securitySalt'] . $formFields->password));

        // save data
        if ($login->save() === false) {
            // fetch all messages from model
            foreach ($login->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            return $this->dispatcher->forward([
                'action' => 'resetPasswordForm',
                'params' => [$form],
            ]);
        }
        
        // clean up
        $form->clear();
        $this->flashSession->success("Password was updated successfully");
        return $this->redirectTo("logins/profile");
    }
    
    public function resetPasswordFormAction($item){
        if(is_a($item,'ResetPasswordForm')){
            // Get item from form
            $this->view->form = $item;
        } else {
            $resetPasswordFormFields = new ResetPasswordFormFields();
            $resetPasswordFormFields->login_id = $item;
            $this->view->form = new ResetPasswordForm($resetPasswordFormFields);
        }
    }
}

/**
* helper class
*/
class ResetPasswordFormFields{
    public $login_id = 0;
    public $old_password = "";
    public $password = "";
    public $confirm_password = "";
}