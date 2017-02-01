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
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation;
use Phalcon\Validation\Validator\StringLength as StringLengthValidator;
use Phalcon\Validation\Validator\Regex as RegexValidator;
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;

class LoginsForm extends FormBase
{
    
    public function initialize($entity = null, $userOptions = null)
    {

        $this->add(new Hidden("id"));

        // loginname
        /*$element = new Text("loginname");
        $element->setLabel("Loginname");
        $element->setAttribute("placeholder","Loginname");
        $element->setFilters(array('striptags', 'string', 'lower'));
        $this->add($element);*/
        
        // title
        $element = new Text("title");
        $element->setLabel("Title");
        $element->setAttribute("placeholder","Title");
        $element->setFilters(array('striptags', 'string'));
        $this->add($element);
        
        // lastname
        $element = new Text("lastname");
        $element->setLabel("Lastname");
        $element->setAttribute("placeholder","Lastname");
        $element->setFilters(array('striptags', 'string'));
        $this->add($element);
        
        // firstname
        $element = new Text("firstname");
        $element->setLabel("Firstname");
        $element->setAttribute("placeholder","Firstname");
        $element->setFilters(array('striptags', 'string'));
        $this->add($element);
        
        // email
        $element = new Text("email");
        $element->setLabel("E-Mail");
        $element->setAttribute("placeholder","E-Mail");
        $element->setFilters(array('striptags', 'string'));
        $this->add($element);
        
        // phone
        $element = new Text("phone");
        $element->setLabel("Phone");
        $element->setAttribute("placeholder","Phone");
        $element->setFilters(array('striptags', 'string'));
        $this->add($element);
        
        // comment
        $element = new TextArea("comment");
        $element->setLabel("Comment");
        $element->setAttribute("placeholder","Comment");
        $element->setFilters(array('striptags', 'string'));
        $this->add($element);
    }
}