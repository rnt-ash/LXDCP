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

class FormBase extends Form
{
    /**
    * appends a Message to this forms element
    * 
    * @param Phalcon\Validation\Message $msg
    */
    public function appendMessage($msg)
    {
        if (!isset($this->_elements[$msg->getField()])) 
            $this->_elements[$msg->getField()] = new \Phalcon\Validation\Message\Group();
        $this->_elements[$msg->getField()]->appendMessage($msg);        
    }
}
?>
