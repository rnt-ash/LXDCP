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

/**
* This controller handles all non secure requests
* Log In, Log out, Reset password, New sign up
*/

class AccessController extends ControllerBase
{

    private function _registerSession(Logins $login)
    {
        $this->session->set('auth', array(
            'id'         => $login->id,
            'loginname'  => $login->loginname,
            'email'      => $login->email,
            'admin'      => $login->admin,
            'role'       => 'admin', // ToDo: Rolle anhand User erkennen..
            'settings'   => $login->settings,
        ));
    }

    /**
    * Login Page
    */
    public function loginAction()
    {

        // set page title
        $this->view->pageTitle = 'Log In';

        // process post if not forwarded from other actions (forgotPassword)
        if ( !$this->dispatcher->wasForwarded() && $this->request->isPost() ) {

            // Receiving the variables sent by POST
            $loginname    = $this->filter->sanitize($this->request->getPost('loginname', 'string'), "trim");
            $password     = $this->filter->sanitize($this->request->getPost('password'), "trim");
            $hashPassword = hash('sha256', $this->config->application['securitySalt'] . $password);

            // find user in the database
            $login = Logins::findFirst(array(
                "loginname = :loginname: AND password = :password: AND active = :active:",
                "bind" => array(
                    'loginname' => $loginname,
                    'password'  => $hashPassword,
                    'active'    => true
                )
            ));

            if ( !empty($login) ) {

                // save session
                $this->_registerSession($login);

                // redirect to dashboard
                return $this->response->redirect("/index");
            }
            $this->flashSession->error("Wrong loginname/password.");
        }
    }

    /**
    * Log out
    */
    public function logoutAction()
    {

        // Destroy the whole session
        $this->session->destroy();

        // Destroy Session Cookie
        setcookie($this->config->application->appName, '', time() - 42000, '/');

        // Redirect to home page
        return $this->response->redirect("/login");
    }

    /**
    * Forgot Password
    */
    public function forgotPasswordAction()
    {
        
        // set page title
        $this->view->pageTitle = 'Forgot Password';

        // process post
        if ($this->request->isPost()) {

            // Receiving the variables sent by POST
            $loginname = $this->filter->sanitize($this->request->getPost('loginname', 'string'), "trim");

            if ( !empty($loginname) ) {

                // find user in the database
                $login = Logins::findFirst(array(
                    "loginname = :loginname: AND active = :active:",
                    "bind" => array(
                        'loginname' => $loginname,
                        'active' => true
                    )
                ));

                if ( !empty($login) ) {

                    // generate reset hash
                    $resetHashToken = $this->security->hash('forgotPassword' . date('mdY H:m:s') . $loginname);

                    // save hash in database
                    $login->hashtoken_reset = $resetHashToken;
                    $login->hashtoken_expire = date('Y-m-d H:i:s', strtotime('+' . $this->config->application->hashTokenExpiryHours . ' hours'));

                    if ( $login->update() == false ) {
                        $this->logger->error("Failed to save user forgot password hash");
                        foreach ($login->getMessages() as $message) {
                            $this->logger->error($message->getMessage());
                        }

                        $this->flashSession->error('Sorry, we could not initiate forgot password process. Please try again.');
                    } else {

                        // email user
                        /*
                        Basics::sendEmail( array(
                            'type'     => 'reset',
                            'toName'   => $login->first_name . " " . $login->last_name,
                            'toEmail'  => $login->username,
                            'resetUrl' => $this->config->application['baseUrl'] . '/reset-password/' . $resetHashToken
                        ));
                        */
                        // Todo: send mail with phpmailer
                        mail($login->Email,"Reset Password","http://".$_SERVER['HTTP_HOST'].$this->config->application['baseUrl'] . '/reset-password/' . $resetHashToken);

                        $this->flashSession->success('Please check your email for instructions on resetting your password.');
                    }

                    // Forward to login
                    return $this->dispatcher->forward(array(
                        'controller' => 'access',
                        'action' => 'login'
                    ));

                } else {
                    $this->flashSession->error('Sorry, we could not find a user with that address. Please try again.');
                }

            } else {
                $this->flashSession->error('Sorry, we could not find a user with that address. Please try again.');
            }
        }

    }

    /**
    * Reset Password
    */
    public function resetPasswordAction()
    {
        
        // set page title
        $this->view->pageTitle = 'Reset Password';

        $resetHashToken = $this->dispatcher->getParam("token");
        if ( empty($resetHashToken) ) {

            $this->flashSession->error('Invalid reset link');

            // Forward to login
            return $this->dispatcher->forward(array(
                'controller' => 'access',
                'action'     => 'login'
            ));
        } else {

            // verify hash token exists in database
            // find user in the database
            $login = Logins::findFirst(array(
                "hashtoken_reset = :token: AND active = :active: AND hashtoken_expire IS NOT NULL AND hashtoken_expire > NOW()",
                "bind" => array(
                    'token'  => $resetHashToken,
                    'active' => true
                )
            ));

            if ( empty($login) ) {
                $this->flashSession->error('Your password reset link has expired. Try send the reset request again.');

                // Forward to login
                return $this->dispatcher->forward(array(
                    'controller' => 'access',
                    'action'     => 'login'
                ));
            }

            $this->view->resetHashToken = $resetHashToken;
        }

        // process post
        if ( $this->request->isPost() ) {

            // Receiving the variables sent by POST
            $newPassword     = $this->filter->sanitize($this->request->getPost('new_password'), "trim");
            $confirmPassword = $this->filter->sanitize($this->request->getPost('confirm_password'), "trim");

            if ( !empty($newPassword) && !empty($confirmPassword) ) {

                // match the two passwords
                if ( $newPassword == $confirmPassword ) {

                    // update password
                    $password = hash('sha256', $this->config->application['securitySalt'] . $newPassword);
                    $login->password = $password;
                    $login->hashtoken_reset = null;
                    $login->hashtoken_expire = null;
                    if ( $login->update() == false ) {
                        $this->logger->error("Failed to reset user's password");
                        foreach ($login->getMessages() as $message) {
                            $this->logger->error($message->getMessage());
                        }

                        $this->flashSession->error('Sorry, we could not reset your password. Please try again.');
                    } else {

                        // email user
                        /*
                        Basics::sendEmail( array(
                            'type'     => 'resetConfirm',
                            'toName'   => $user->first_name . " " . $user->last_name,
                            'toEmail'  => $user->username
                        ));
                        */
                        // Todo: send mail with phpmailer
                        mail($login->getEmail(),"Reset Confirm","Password changed");

                        $this->flashSession->success('Your password has been changed. You can now log in with your new password.');
                        
                        // Forward to login
                        return $this->dispatcher->forward(array(
                            'controller' => 'access',
                            'action'     => 'login'
                        ));
                    }

                } else {
                    $this->flashSession->error('Both passwords should match.');
                }

            } else {
                $this->flashSession->error('Please enter both passwords.');
            }
        }
    }

}
