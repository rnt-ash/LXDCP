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

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Mvc\Model\Message as Message;

class Customers extends \Phalcon\Mvc\Model
{

    /**
    *
    * @var integer
    * @Primary
    * @Identity
    */
    protected $id;

    /**
    *
    * @var string
    */
    protected $lastname;

    /**
    *
    * @var string
    */
    protected $firstname;

    /**
    *
    * @var string
    */
    protected $company;

    /**
    *
    * @var string
    */
    protected $company_add;

    /**
    *
    * @var string
    */
    protected $street;

    /**
    *
    * @var string
    */
    protected $po_box;

    /**
    *
    * @var string
    */
    protected $zip;

    /**
    *
    * @var string
    */
    protected $city;

    /**
    *
    * @var string
    */
    protected $phone;

    /**
    *
    * @var string
    */
    protected $email;

    /**
    *
    * @var string
    */
    protected $website;

    /**
    *
    * @var string
    */
    protected $comment;

    /**
    *
    * @var integer
    */
    protected $active;

    /**
    * Unique ID
    *
    * @param integer $id
    * @return $this
    */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
    * Lastname
    *
    * @param string $lastname
    * @return $this
    */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
    * Firstname
    *
    * @param string $firstname
    * @return $this
    */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
    * Company name
    *
    * @param string $company
    * @return $this
    */
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

    /**
    * Additional text to the company name
    *
    * @param string $company_add
    * @return $this
    */
    public function setCompanyAdd($company_add)
    {
        $this->company_add = $company_add;
        return $this;
    }

    /**
    * Street
    *
    * @param string $street
    * @return $this
    */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
    * P.O. Box
    *
    * @param string $po_box
    * @return $this
    */
    public function setPoBox($po_box)
    {
        $this->po_box = $po_box;
        return $this;
    }

    /**
    * zip code
    *
    * @param string $zip
    * @return $this
    */
    public function setZip($zip)
    {
        $this->zip = $zip;
        return $this;
    }

    /**
    * City name
    *
    * @param string $city
    * @return $this
    */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
    * A selection of telephone numbers, saved to a textfield
    *
    * @param string $phone
    * @return $this
    */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
    * E-mail
    *
    * @param string $email
    * @return $this
    */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
    * Website
    *
    * @param string $website
    * @return $this
    */
    public function setWebsite($website)
    {
        $this->website = $website;
        return $this;
    }

    /**
    * Comment
    *
    * @param string $comment
    * @return $this
    */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
    * is this customer active?
    *
    * @param integer $active
    * @return $this
    */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
    * Returns the value of field id
    *
    * @return integer
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    * Returns the value of field lastname
    *
    * @return string
    */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
    * Returns the value of field firstname
    *
    * @return string
    */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
    * Returns the value of field company
    *
    * @return string
    */
    public function getCompany()
    {
        return $this->company;
    }

    /**
    * Returns the value of field company_add
    *
    * @return string
    */
    public function getCompanyAdd()
    {
        return $this->company_add;
    }

    /**
    * Returns the value of field street
    *
    * @return string
    */
    public function getStreet()
    {
        return $this->street;
    }

    /**
    * Returns the value of field po_box
    *
    * @return string
    */
    public function getPoBox()
    {
        return $this->po_box;
    }

    /**
    * Returns the value of field zip
    *
    * @return string
    */
    public function getZip()
    {
        return $this->zip;
    }

    /**
    * Returns the value of field city
    *
    * @return string
    */
    public function getCity()
    {
        return $this->city;
    }

    /**
    * Returns the value of field phone
    *
    * @return string
    */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
    * Returns the value of field email
    *
    * @return string
    */
    public function getEmail()
    {
        return $this->email;
    }

    /**
    * Returns the value of field website
    *
    * @return string
    */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
    * Returns the value of field comment
    *
    * @return string
    */
    public function getComment()
    {
        return $this->comment;
    }

    /**
    * Returns the value of field active
    *
    * @return integer
    */
    public function getActive()
    {
        return $this->active;
    }

    /**
    * Initialize method for model.
    */
    public function initialize()
    {
        // set relations
        $this->hasMany("id","Logins","customers_id",array("foreignKey"=>true));
        $this->hasMany("id","Colocations","customers_id",array("foreignKey"=>true));
        $this->hasMany("id","PhysicalServers","customers_id",array("foreignKey"=>true));
        $this->hasMany("id","VirtualServers","customers_id",array("foreignKey"=>true));
    }

    /**
    * Validations and business logic
    *
    * @return boolean
    */
    public function validation()
    {
        // validators
        $validator = new Validation();
        $validator->add('email', new EmailValidator([
            'message' => 'Please enter a correct email address',
            'allowEmpty' => true,
        ]));

        $validator->add('company', new StringLength([
            'max' => 50,
            'min' => 3,
            'messageMaximum' => 'company name too long',
            'messageMinimum' => 'company name too small',
            'allowEmpty' => true,
        ]));
        if(!$this->validate($validator)) return false;
        
        // business logic
        if(empty($this->lastname) && empty($this->company)){
          $message = new Message(
                "lastname or company must set",
                "id"
            );            

           $this->appendMessage($message);
           return false;        
        }        
        
        return true;
    }

    /**
    * beforeDelete - Event
    * 
    * @return boolen
    */
    public function beforeDelete()
    {
        if ($this->id == 1) {
            $message = new Message("Der Kunde mit der ID=1 kann nicht gelöscht werden. (Administrator)");
            $this->appendMessage($message);
            return false;
        }
        return true;
    }

    /**
    * Gibt einen String aus den Kundendaten zurück
    * 
    * @param integer $id Kunden ID
    * @param string $type 'line', 'box', 'short', 'shortlastfirst', 'namecity'
    */
    public function printAddressText($type='line'){
        $sAdress = "";

        switch($type){
            case 'box':
                $sCompany  = !empty($this->company_add) ? trim($this->company."\n".$this->company_add) : trim($this->company);
                $sName     = !empty($this->lastname) ? trim($this->firstname.' '.$this->lastname):"";
                $sAdress   = !empty($sCompany) ? $sCompany."\n" : "";   
                $sAdress  .= !empty($this->department)? trim($this->department)."\n":"";
                $sAdress  .= !empty($sName) ? $sName."\n" : "";   
                $sAdress  .= !empty($this->street)? trim($this->street)."\n":"";
                $sAdress  .= !empty($this->po_box)? trim($this->po_box)."\n":"";
                $sAdress  .= trim($this->zip.' '.$this->city); 
                break;
            case 'short':
                $sCompany  = trim($this->company);
                $sName     = !empty($this->lastname) ? trim($this->firstname.' '.$this->lastname):"";
                $sAdress   = !empty($sCompany) ? $sCompany.", " : (!empty($sName) ? $sName.", " : "");   
                $sAdress  .= !empty($this->street)? trim($this->street).", ":"";
                $sAdress  .= trim($this->city); 
                break;
            case 'shortlastfirst':
                // Nachnahme steht vor Vorname
                $sCompany  = trim($this->company);
                $sName     = !empty($$this->lastname) ? trim($this->lastname.' '.$this->firstname):"";
                $sAdress   = !empty($sCompany) ? $sCompany.", " : (!empty($sName) ? $sName.", " : "");   
                $sAdress  .= !empty($this->street)? trim($this->street).", ":"";
                $sAdress  .= trim($this->city); 
                break;
            case 'namecity':
                $sCompany  = trim($this->company);
                $sName     = !empty($this->lastname) ? trim($this->firstname.' '.$this->lastname):"";
                $sAdress   = !empty($sCompany) ? $sCompany.", " : (!empty($sName) ? $sName.", " : "");   
                $sAdress  .= trim($this->city); 
                break;
            case 'line':
            default:
                $sCompany  = !empty($this->company_add) ? trim($this->company.", ".$this->company_add) : trim($this->company);
                $sName     = !empty($this->lastname) ? trim($this->firstname.' '.$this->lastname):"";
                $sAdress   = !empty($sCompany) ? $sCompany.", " : "";   
                $sAdress  .= !empty($this->department)? trim($this->department).", ":"";
                $sAdress  .= !empty($sName) ? $sName.", " : "";   
                $sAdress  .= !empty($this->street)? trim($this->street).", ":"";
                $sAdress  .= !empty($this->po_box)? trim($this->po_box).", ":"";
                $sAdress  .= trim($this->zip.' '.$this->city); 
        }

        return $sAdress;
    }

    /**
    * Gibt die Werte pro Kolonne für das TabelData Element zurück
    * 
    * @param mixed $row
    */
    public function printTableData($row){
        switch($row){
            case "kdnr":
                return $this->id;
                break;
            case "name":
                return (empty($this->firstname)?"":$this->firstname." ").$this->lastname;
                break;
            case "company":
                return $this->company;
                break;    
            case "city":
                return $this->city;
                break;
        }
    }
}
