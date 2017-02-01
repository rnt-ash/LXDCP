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

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation;
use Phalcon\Validation\Validator\StringLength as StringLengthValidator;
use Phalcon\Validation\Validator\Regex as RegexValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\Confirmation as ConfirmationValidator;
use Phalcon\Validation\Validator\Identical as IdenticalValidator;

class ResetPasswordForm extends FormBase
{
    
    public function initialize($entity = null, $userOptions = null)
    {
        $this->add(new Hidden("login_id"));

        // old password
        $element = new Password("old_password");
        $element->setLabel("old password");
        $element->setAttribute("placeholder","password");
        $element->setFilters(array('striptags', 'string', 'trim'));
        $element->addValidators(array(
            new PresenceOfValidator(array(
                'message' => 'old password is required'
            ))
        ));
        $this->add($element);
        
        // new password
        $element = new Password("password");
        $element->setLabel("new password");
        $element->setAttribute("placeholder","password");
        $element->setFilters(array('striptags', 'string', 'trim'));
        $element->addValidators(array(
            new PresenceOfValidator(array(
                'message' => 'new password is required'
            )),
            new RegexValidator(array(
                'pattern' => '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d_\.-]{8,12}$/',
                'message' => 'Password must be alphanumeric and may contain the characters ._- <br />
                            Minimum 8 characters, Maximum 12 characters at least 1 Letter and 1 Number'
            ))
        ));
        $this->add($element);
        
        // confirm password
        $element = new Password("confirm_password");
        $element->setLabel("confirm password");
        $element->setAttribute("placeholder","password");
        $element->setFilters(array('striptags', 'string', 'trim'));
        $element->addValidators(array(
            new PresenceOfValidator(array(
                'message' => 'confirm password is required'
            )),
            new ConfirmationValidator(array(
                'message' => 'Password doesn\'t match confirmation',
                'with' => 'password'
            ))
        ));
        $this->add($element);
    }
}