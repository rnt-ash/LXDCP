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

use Phalcon\Di\FactoryDefault;

class RemoteSshConnection{
    
    private $Logger;
    
    private $Host;
    
    private $Port;
    
    private $User;
    
    private $Password;
    
    private $Connection;
    
    private $ConnectionOpened;
    
    private $LastExitStatus;
    
    /**
    * @param string $host fqdn
    * @param string $user
    * @param string $password
    * @param inz $port default 22
    */
    public function __construct(FactoryDefault $di, $host, $user, $password, $port = 22){
        $this->Logger = $di['logger'];
        $this->Host = $host;
        $this->User = $user;
        $this->Password = $password;
        $this->Port = $port;
        $this->LastExitStatus = 0;
        
        $this->open();
    }
    
    /**
    * Opens the ssh connection.
    * 
    */
    public function open(){
        $this->Connection = @ssh2_connect($this->Host, $this->Port);
        // @ is the silent operator, which causes the ssh2_* functions not to generate php errors
        if (@ssh2_auth_password($this->Connection, $this->User, $this->Password)) {
        //if (true || ssh2_auth_password($this->Connection, $this->User, $this->Password)) {
            $this->ConnectionOpened = true;
            $this->Logger->debug("RemoteSshConnection: successfully opened connection to ".$this->Host." on Port ".$this->Port);
        }else{
            $this->ConnectionOpened = false;
            $error = "Failed to open connection to ".$this->Host.":".$this->Port." with username ".$this->User." and given password";
            $this->Logger->error($error);
            throw new Exception($error);
        }
    }

    /**
    * Closes the ssh connection.
    * 
    * @throws Exception
    */
    public function close(){
        $this->exec('echo "EXITING" && exit;'); 
        $this->Connection = null; 
        $this->ConnectionOpened = false;
        $this->Logger->debug("RemoteSshConnection: successfully closed connection to ".$this->Host);
    }

    /**
    * Executes specified command on RemoteSshConnection.
    * 
    * @param string $cmd
    * @return string output
    * @throws Exception
    */
    public function exec($cmd) { 
        $this->Logger->debug("RemoteSshConnection: Execute Command '".$cmd."' on ".$this->Host);
        
        // add to command so that last line is exit status (no other simple way to get the exit status over ssh2_exec)
        $cmd .= ';echo -e "\n$?"';
        
        // @ is the silent operator, which causes the ssh2_* functions not to generate php errors
        if (!($stream = @ssh2_exec($this->Connection, $cmd))) { 
            $error = 'remote ssh command failed: "'.$cmd.'"';
            $this->Logger->error("RemoteSshConnection: ".$error);
            throw new Exception($error); 
        } 
        stream_set_blocking($stream, true); 
        $data = ""; 
        while ($buf = fread($stream, 4096)) { 
            $data .= $buf; 
        }
        
        // extract exit status and setting output together
        $lines = explode("\n",$data);
        array_pop($lines); //pop the last newline out
        $this->LastExitStatus = array_pop($lines); // pop the exit status
        $data = implode("\n",$lines);
        
        fclose($stream); 
        if(!empty($data)){
            $this->Logger->debug("RemoteSshConnection: got output from last command: '".$data."'");
        } 
        return $data;
    }
    
    public function getLastExitStatus(){
        
    }
    
    public function sendFile($localFile,$remoteFile){
        // @ is the silent operator, which causes the ssh2_* functions not to generate php errors
        if(!@ssh2_scp_send($this->Connection,$localFile,$remoteFile)){
            $error = "Could not send file to remoteserver (".$localFile.")";
            $this->Logger->error($error);
            throw new Exception($error);    
        }
    }
    
    public function receiveFile($remoteFile,$localFile){
        // @ is the silent operator, which causes the ssh2_* functions not to generate php errors
        if(!ssh2_scp_recv($this->Connection,$remoteFile,$localFile)){
            $error = "Could not receive file from remoteserver (".$remoteFile.")";
            $this->Logger->error($error);
            throw new Exception($error);
        }
    }
    
    public function isOpen(){
        return $this->ConnectionOpened;
    }
}
