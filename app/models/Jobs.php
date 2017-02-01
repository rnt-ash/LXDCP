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

use Phalcon\Mvc\Model\Behavior\Timestampable;

class Jobs extends \Phalcon\Mvc\Model
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
    * @var integer
    */
    protected $physical_servers_id;

    /**
    *
    * @var integer
    */
    protected $virtual_servers_id;

    /**
    *
    * @var integer
    */
    protected $logins_id;

    /**
    *
    * @var string
    */
    protected $type;

    /**
    *
    * @var string
    */
    protected $params;

    /**
    *
    * @var string
    */
    protected $created;

    /**
    *
    * @var integer
    */
    protected $dependency;

    /**
    *
    * @var string
    */
    protected $sent;

    /**
    *
    * @var integer
    */
    protected $done;

    /**
    *
    * @var string
    */
    protected $executed;

    /**
    *
    * @var string
    */
    protected $error;

    /**
    *
    * @var string
    */
    protected $retval;

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
    * foreign Key to physical_servers
    *
    * @param integer $serverId
    * @return $this
    */
    public function setPhysicalServersId($serverId)
    {
        $this->physical_servers_id = $serverId;
        return $this;
    }

    /**
    * foreign Key to virtual_servers
    *
    * @param integer $serverId
    * @return $this
    */
    public function setVirtualServersId($serverId)
    {
        $this->virtual_servers_id = $serverId;
        return $this;
    }

    /**
    * id of the user who executed this job
    *
    * @param integer $logins_id
    * @return $this
    */
    public function setLoginsId($logins_id)
    {
        $this->logins_id = $logins_id;
        return $this;
    }

    /**
    * Job type
    *
    * @param string $type
    * @return $this
    */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
    * Job params
    *
    * @param string $params
    * @return $this
    */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
    * Time of creating the job
    *
    * @param string $created
    * @return $this
    */
    /*
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }
    */
    
    /**
    * Job dependency
    *
    * @param integer $dependency
    * @return $this
    */
    public function setDependency($dependency)
    {
        $this->dependency = $dependency;
        return $this;
    }

    /**
    * Time of job sent
    *
    * @param string $sent
    * @return $this
    */
    public function setSent($sent)
    {
        $this->sent = $sent;
        return $this;
    }

    /**
    * Job done
    *
    * @param integer $done -1: executing, 0: created, 1: success, 2: error
    * @return $this
    */
    public function setDone($done)
    {
        $this->done = $done;
        return $this;
    }

    /**
    * time of job executed
    *
    * @param string $executed
    * @return $this
    */
    public function setExecuted($executed)
    {
        $this->executed = $executed;
        return $this;
    }

    /**
    * Job error
    *
    * @param string $error
    * @return $this
    */
    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    /**
    * Job retval
    *
    * @param string $retval
    * @return $this
    */
    public function setRetval($retval)
    {
        $this->retval = $retval;
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
    * Returns the value of field dco_typ
    *
    * @return integer
    */
    public function getDcoTyp()
    {
        return $this->dco_typ;
    }

    /**
    * Returns the value of field logins_id
    *
    * @return integer
    */
    public function getLoginsId()
    {
        return $this->logins_id;
    }

    /**
    * Returns the value of field type
    *
    * @return string
    */
    public function getType()
    {
        return $this->type;
    }

    /**
    * Returns the value of field params
    *
    * @return string
    */
    public function getParams()
    {
        return $this->params;
    }

    /**
    * Returns the value of field created
    *
    * @return string
    */
    public function getCreated()
    {
        return $this->created;
    }

    /**
    * Returns the value of field dependency
    *
    * @return integer
    */
    public function getDependency()
    {
        return $this->dependency;
    }

    /**
    * Returns the value of field sent
    *
    * @return string
    */
    public function getSent()
    {
        return $this->sent;
    }

    /**
    * Returns the value of field done
    *
    * @return integer
    */
    public function getDone()
    {
        return $this->done;
    }

    /**
    * Returns the value of field executed
    *
    * @return string
    */
    public function getExecuted()
    {
        return $this->executed;
    }

    /**
    * Returns the value of field error
    *
    * @return string
    */
    public function getError()
    {
        return $this->error;
    }

    /**
    * Returns the value of field retval
    *
    * @param boolean $asArray convert the returnvalue from JSON to an associative array
    * @return string
    */
    public function getRetval($asArray=false)
    {
        if($asArray)
            return json_decode($this->retval,true);
        else
            return $this->retval;
    }

    /**
    * helper method: set linked server
    * 
    */
    public function setServer(JobServerInterface $server){
        if($server->getDcoType()==2)
            $this->physical_servers_id = $server->id;
        else
            $this->virtual_servers_id = $server->id;
    }
    
    /**
    * helper method: returns linked server
    * 
    * return JobServerInterface $server
    */
    public function getServer(){
        if(!empty($this->physical_servers_id))
            return PhysicalServers::findFirstById($this->physical_servers_id);
        else
            return VirtualServers::findFirstById($this->virtual_servers_id);
    }
    
    /**
    * Initialize method for model.
    */
    public function initialize()
    {
        $this->belongsTo("physical_servers_id","PhysicalServers","id",array("foreignKey"=>array("allowNulls"=>true)));
        $this->belongsTo("virtual_servers_id","VirtualServers","id",array("foreignKey"=>array("allowNulls"=>true)));
        $this->belongsTo("logins_id","Logins","id",array("foreignKey"=>true));

        // Timestampable behavior
        $this->addBehavior(new Timestampable(array(
            'beforeCreate' => array(
                'field' => 'created',
                'format' => 'Y-m-d H:i:s'
            )
        )));   
    }
}
