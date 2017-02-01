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
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email as EmailValidator;

class CustomersForm extends Form
{

    public function appendMessage($field = '', $msg)
    {
        if (!isset($this->_elements[$field])) 
            $this->_elements[$field] = new \Phalcon\Validation\Message\Group();
        $this->_elements[$field]->appendMessage($msg);
        
        /*
        if (isset($this->_messages)) {
            $this->_messages->appendMessage($msg);
        } else {
            $this->_messages = new \Phalcon\Validation\Message\Group();
            $this->_messages->appendMessage($msg);
        }
        */
    }
    
    public function initialize($entity = null)
    {
        $this->add(new Hidden("id"));

        // firstname
        $element = new Text("firstname");
        $element->setLabel("Firstname");
        $element->setFilters(array('striptags', 'string', 'trim'));
//        $element->addValidators(array(
//            new PresenceOf(array(
//                'message' => 'Firstname is required'
//            ))
//        ));
        $this->add($element);

        // lastname
        $element = new Text("lastname");
        $element->setLabel("Lastname");
        $element->setFilters(array('striptags', 'string', 'trim'));
        $this->add($element);

        // company
        $element = new Text("company");
        $element->setLabel("Company");
        $element->setFilters(array('striptags', 'string', 'trim'));
        $this->add($element);
        
        // company_add
        $element = new TextArea("company_add");
        $element->setLabel("Company Add");
        $element->setFilters(array('striptags', 'string', 'trim'));
        $this->add($element);
        
        // street
        $element = new Text("street");
        $element->setLabel("Street");
        $element->setFilters(array('striptags', 'string', 'trim'));
        $this->add($element);

        // p.o. box
        $element = new Text("po_box");
        $element->setLabel("P.O. Box");
        $element->setFilters(array('striptags', 'string', 'trim'));
        $this->add($element);

        // zip
        $element = new Text("zip");
        $element->setLabel("Zip Code");
        $element->setFilters(array('striptags', 'string', 'trim'));
        $this->add($element);
        
        // city
        $element = new Text("city");
        $element->setLabel("City");
        $element->setFilters(array('striptags', 'string', 'trim'));
        $this->add($element);

        // phone
        $element = new TextArea("phone");
        $element->setLabel("Phone");
        $element->setFilters(array('striptags', 'string', 'trim'));
        $this->add($element);

        // email
        $element = new Text("email");
        $element->setLabel("E-mail");
        $element->setFilters(array('email'));
        $this->add($element);

        // website
        $element = new Text("website");
        $element->setLabel("Website");
        $element->setFilters(array('striptags', 'string', 'trim'));
        $this->add($element);

        // comment
        $element = new TextArea("comment");
        $element->setLabel("Comment");
        $element->setFilters(array('striptags', 'string', 'trim'));
        $this->add($element);

        // active
        $element = new Check("active");
        $element->setLabel("Active");
        $element->setFilters(array('int'));
        $this->add($element);


    }

}