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
use Phalcon\Validation\Validator\PresenceOf as PresenceOfValidator;
use Phalcon\Validation\Validator\Regex as RegexValidator;
use Phalcon\Validation\Validator\Alpha as AlphaValidator;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class Logins extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=false)
     */
    protected $loginname;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    protected $password;

    /**
    * Password hashtoken
    * 
    * @var string
    */
    protected $hashtoken;

    /**
    * Password hashtoken reset
    * 
    * @var string
    */
    protected $hashtoken_reset;
    
    /**
    * Password hashtoken reset
    * 
    * @var string
    */
    protected $hashtoken_expire;
    
    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $customers_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $admin;

    /**
     *
     * @var string
     * @Column(type="string", length=25, nullable=true)
     */
    protected $title;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $lastname;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $firstname;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $phone;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $comment;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=false)
     */
    protected $email;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $active;

    /**
    * 
    * @var string
    *  @Column(type=sting, nullable=false)
    */
    protected $settings;
    
    /**
     * Method to set the value of field id
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
     * Method to set the value of field loginname
     *
     * @param string $loginname
     * @return $this
     */
    public function setLoginname($loginname)
    {
        $this->loginname = $loginname;

        return $this;
    }

    /**
     * Method to set the value of field password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Method to set the value of field hashtoken
     *
     * @param string $hashtoken
     * @return $this
     */
    public function setHashtoken($hashtoken)
    {
        $this->hashtoken = $hashtoken;

        return $this;
    }

    /**
     * Method to set the value of field hashtoken_reset
     *
     * @param string $hashtoken
     * @return $this
     */
    public function setHashtokenReset($hashtoken_reset)
    {
        $this->hashtoken_reset = $hashtoken_reset;

        return $this;
    }

    /**
     * Method to set the value of field hashtoken_expire
     *
     * @param string $hashtoken
     * @return $this
     */
    public function setHashtokenExpire($hashtoken_expire)
    {
        $this->hashtoken_expire = $hashtoken_expire;

        return $this;
    }

    /**
     * Method to set the value of field customers_id
     *
     * @param integer $customers_id
     * @return $this
     */
    public function setCustomersId($customers_id)
    {
        $this->customers_id = $customers_id;

        return $this;
    }

    /**
     * Method to set the value of field admin
     *
     * @param integer $admin
     * @return $this
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Method to set the value of field title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Method to set the value of field lastname
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
     * Method to set the value of field firstname
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
     * Method to set the value of field phone
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
     * Method to set the value of field comment
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
     * Method to set the value of field email
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
     * Method to set the value of field active
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
    * Method to set the value of field settings
    * 
    * @param array $settings
    * @return $this
    */
    public function setSettings($settings)
    {
        $this->settings = json_encode($settings);
        
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
     * Returns the value of field loginname
     *
     * @return string
     */
    public function getLoginname()
    {
        return $this->loginname;
    }

    /**
     * Returns the value of field password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the value of field hashtoken
     *
     * @return string
     */
    public function getHashtoken()
    {
        return $this->hashtoken;
    }

    /**
     * Returns the value of field hashtoken_reset
     *
     * @return string
     */
    public function getHashtokenReset()
    {
        return $this->hashtoken_reset;
    }

    /**
     * Returns the value of field hashtoken_expire
     *
     * @return string
     */
    public function getHashtokenExpire()
    {
        return $this->hashtoken_expire;
    }

    /**
     * Returns the value of field customers_id
     *
     * @return integer
     */
    public function getCustomersId()
    {
        return $this->customers_id;
    }

    /**
     * Returns the value of field admin
     *
     * @return integer
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Returns the value of field title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
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
     * Returns the value of field phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
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
     * Returns the value of field email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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
     * Returns the value of field settings
     *
     * @return array
     */
    public function getSettings()
    {
        return json_decode($this->settings,true);
    }

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = $this->generateValidator();
        if(!$this->validate($validator)) return false;
        
        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo("customers_id","Customers","id",array("foreignKey"=>true));
        $this->hasMany("id","Jobs","logins_id",array("foreignKey"=>array("allowNulls"=>true)));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'logins';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Logins[]|Logins
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Logins
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    
    /**
    * generates validator for Logins model
    * 
    * return \Phalcon\Validation $validator
    * 
    */
    public static function generateValidator(){
        
        // validator
        $validator = new Validation();

        // loginname
        $validator->add('loginname', new PresenceOfValidator([
            'message' => 'loginname is required'
        ]));
        
        $validator->add('loginname', new RegexValidator([
            'pattern' => '/^[a-z][a-z\d]{2,15}$/',
            'message' => 'loginname may only contain letters, numbers and must be between 3 and 32 characters.',
        ]));
        
        $validator->add('loginname', new UniquenessValidator([
            'message' => 'loginname is already in use'
        ]));
        
        // title
        $validator->add('title', new PresenceOfValidator([
            'message' => 'title is required'
        ]));
        
        $validator->add('title', new AlphaValidator([
            'message' => 'title must contain only letters'
        ]));
        
        // lastname
        $validator->add('lastname', new PresenceOfValidator([
            'message' => 'lastname is required'
        ]));
        
        $validator->add('lastname', new AlphaValidator([
            'message' => 'lastname must contain only letters'
        ]));

        // firstname
        $validator->add('firstname', new PresenceOfValidator([
            'message' => 'firstname is required'
        ]));
        
        $validator->add('firstname', new AlphaValidator([
            'message' => 'firstname must contain only letters'
        ]));
        
        // email
        $validator->add('email', new PresenceOfValidator([
            'message' => 'email is required'
        ]));
        
        $validator->add('email', new EmailValidator([
            'message' => 'The e-mail is not valid'
        ]));
        
        // phone
        $validator->add('phone', new PresenceOfValidator([
            'message' => 'phone is required'
        ]));
        
        $validator->add('phone', new RegexValidator([
            'pattern' => '/^[+]?[0-9\s]{1,}$/',
            'message' => 'phone can begin with a plus and may only contain numbers.'
        ]));
        
        return $validator;
    }
}
