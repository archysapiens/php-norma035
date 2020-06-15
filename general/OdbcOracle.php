<?php
/*****
 * This OracleConnectManager class is written for a web application project.
 * This class will manage the connection for oracle, written for php >=5 (for 11g, it is working).
 *
 *
 *
 * Written by Mohammad Ashrafuddin Ferdousi.
 * email: it.codeperl@gmail.com
 * Licensed under GNU, GPL.
 *
 *
 */
class OracleConnectManager {
    //oracle database username.(root)
    private $oracle_user = NULL;
    //oracle database password. (password)
    private $oracle_password = NULL;
    //oracle database hostname. (xxx.xxx.x.xx)
    private $oracle_host = NULL;
    //oracle database port. (xxxx)
    private $oracle_port = NULL;
    //oracle database sid. (db10g and db11g)
    private $oracle_sid = NULL;
    /****oracle connection string. ((DESCRIPTION =
                                            (ADDRESS_LIST =
                                              (ADDRESS = (COMMUNITY = tcp.world)(PROTOCOL = TCP)(HOST = %s)(PORT = %s))
                                            )
                                            (CONNECT_DATA =
                                              (SID = %s)
                                            )
                                          ))
    ****/
    private $connection_string = NULL;
 
    /***
     * The __construct method of OracleConnectManager class is used to
     * initialize the private property,
     * oracle_user,
     * oracle_password,
     * oracle_host,
     * oracle_port,
     * oracle_sid
     * with default values.
     * Change this property's value from setDefaultProperties, as required.
     */
 
    function __construct() {
        /***
         *Calling setDefaultProperties method of OracleConnectManager class.
         */
        $this->setDefaultProperties();
    }
 
    /***
     * The setDefaultProperties method of OracleConnectManager class is used to
     * initialize the private property,
     * oracle_user,
     * oracle_password,
     * oracle_host,
     * oracle_port,
     * oracle_sid
     * with default values.
     * Change this property's value from setDefaultProperties, as required.
     */
 
    function setDefaultProperties() {
        //oracle database username.(root)
        $this->oracle_user = 'system';
        //oracle database password. (password)
        $this->oracle_password = 'oracle';
        //oracle database hostname. (xxx.xxx.x.xx)
        $this->oracle_host = 'a92.168.1.65';
        //oracle database port. (xxxx)
        $this->oracle_port = '1521';
        //oracle database sid. (db10g and db11g)
        $this->oracle_sid = 'orcl';
        /****oracle connection string. ((DESCRIPTION =
                                            (ADDRESS_LIST =
                                              (ADDRESS = (COMMUNITY = tcp.world)(PROTOCOL = TCP)(HOST = %s)(PORT = %s))
                                            )
                                            (CONNECT_DATA =
                                              (SID = %s)
                                            )
                                          ))
        ****/
        $this->connection_string = " (DESCRIPTION =
                                            (ADDRESS_LIST =
                                              (ADDRESS = (COMMUNITY = tcp.world)(PROTOCOL = TCP)(HOST = %s)(PORT = %s))
                                            )
                                            (CONNECT_DATA =
                                              (SID = %s)
                                            )
                                          )";
 
    }
 
    /**
     * set private property, oracle_user.
     */
 
    public function setOracleUser($userName=NULL) {
        /***
         *set oracle_user by given database username.
         */
        $this->oracle_user = $userName;
    }
 
    /**
     * get private property, oracle_user.
     */
 
    public function getOracleUser() {
        /***
         *return oracle_user.
         */
        return $this->oracle_user;
    }
 
    /**
     * set private property, oracle_password.
     */
 
    public function setOraclePassword($password=NULL) {
        /***
         *set oracle_password by given database password.
         */
        $this->oracle_password = $password;
    }
 
    /**
     * get private property, oracle_password.
     */
 
    public function getOraclePassword() {
        /***
         *return oracle_password.
         */
        return $this->oracle_password;
    }
 
    /**
     * set private property, oracle_port.
     */
 
    public function setOraclePort($port=NULL) {
        /***
         *set oracle_port by given database port.
         */
        $this->oracle_port = $port;
    }
 
    /**
     * get private property, oracle_port.
     */
 
    public function getOraclePort() {
        /***
         *return oracle_port.
         */
        return $this->oracle_port;
    }
 
    /**
     * set private property, oracle_sid.
     */
 
    public function setOracleSid($sid=NULL) {
        /***
         *set oracle_sid by given database sid.
         */
        $this->oracle_sid = $sid;
    }
 
    /**
     * get private property, oracle_sid.
     */
 
    public function getOracleSid() {
        /***
         *return oracle_sid.
         */
        return $this->oracle_sid;
    }
 
    /**
     * set private property, oracle_host.
     */
 
    public function setOracleHost($hostName=NULL) {
        /***
         *set oracle_host by given database host.
         */
        $this->oracle_host = $hostName;
    }
 
    /**
     * get private property, oracle_host.
     */
 
    public function getOracleHost() {
        /***
         *return oracle_host.
         */
        return $this->oracle_host;
    }
 
    /**
     * set private property, connection_string.
     */
 
    public function setConnectionString() {
        /***
         *set connection_string with oracle_host, oracle_port and oracle sid.
         */
        $this->connection_string = sprintf( $this->connection_string, $this->oracle_host,$this->oracle_port,$this->oracle_sid );
    }
 
    /**
     * get private property, connection_string.
     */
 
    public function getConnectionString() {
        /***
         *return connection_string.
         */
        return $this->connection_string;
    }
 
    /**
     * establishConnection is a public method for OracleConnectManager class. It is a wrapper class of oci_pconnect.
     * the username, password and connectionstring parameter is called by $this->getOracleUser(), $this->getOraclepassword() and
     * $this->getConnectionString(), respectively.
     */
 
    public function establishConnection() {
      /***
       * try to establish the connection. if exception created, that will throw an OracleConnectManagerException else return the $connection.
       */
      try{
        $connectionResources = @oci_pconnect($this->getOracleUser(), $this->getOraclePassword(), $this->getConnectionString());
        if(!$connectionResources){
          throw new OracleConnectManagerException("Connection failed for oracle database.");
        }
      }catch(OracleConnectManagerException $exceptions){
        print('<pre style="color:#f00;">');
        print_r( "<br />Error: ".$exceptions->getMessage()."<br />File: ".$exceptions->getFile()."<br />Line no.: ".$exceptions->getLine() );
        print('</pre>');
        exit;
      }
      return $connectionResources;
    }
 
    /**
     * setConnection is a public method which acts as a wrapper class of setConnectionString.
     * It sets the hostName, port, sid, username and password as given parameter. if any parameter is missing, it will set the class's default
     * properties.
     */
 
    public function setConnection($hostName=NULL, $port=NULL, $sid=NULL, $userName=NULL, $password=NULL) {
        /**
         * Check is there any host name, if available, then set the hostname property, else set default property value.
         */
        if (!empty($hostName)) {
            $this->setOracleHost($hostName);
        } else {
            $this->setOracleHost($this->oracle_host);
        }
        /**
         * Check is there any port, if available, then set the port property, else set default property value.
         */
 
        if (!empty($port)) {
            $this->setOraclePort($port);
        } else {
            $this->setOraclePort($this->oracle_port);
        }
        /**
         * Check is there any sid, if available, then set the sid property, else set default property value.
         */
 
        if (!empty($sid)) {
            $this->setOracleSid($sid);
        } else {
            $this->setOracleSid($this->oracle_sid);
        }
        /**
         * Check is there any userName, if available, then set the userName property, else set default property value.
         */
 
        if (!empty($userName)) {
            $this->setOracleUser($userName);
        } else {
            $this->setOracleUser($this->oracle_user);
        }
        /**
         * Check is there any password, if available, then set the password property, else set default property value.
         */
 
        if (!empty($password)) {
            $this->setOraclePassword($password);
        } else {
            $this->setOraclePassword($this->oracle_password);
        }
 
        $this->setConnectionString();
    }
}
/*****
 * This OracleConnectManagerException class is written for a web application project.
 * This class will manage the connection exception for oracle, written for php >=5 (for 11g, it is working).
 *
 *
 *
 * Written by Mohammad Ashrafuddin Ferdousi.
 * email: it.codeperl@gmail.com
 * Licensed under GNU, GPL.
 *
 *
 */
class OracleConnectManagerException extends Exception {
 /*****
  * __construct method for OracleConnectManagerException.
  * It calls the __construct method of main php exception class "Exception".
  *
  */
     public function __construct($message, $code = 0){
        parent::__construct($message, $code);
     }
 /*****
  * __toString method for OracleConnectManagerException.
  * Overridden the Exception class's _toString method.
  *  use getMessage(), getFile(), getLine() and getTrace() methods of parent class.
  */
     public function __toString(){
    /*****
     *overridne the parent __toString method.
     * __construct method for OracleConnectManagerException.
     * It calls the __construct method of main php exception class "Exception".
     *
     */
        parent::__toString();
        return "<b style='color:red'>".$this->getMessage().$this->getFile().$this->getLine().$this->getTrace()."</b>";
     }
}
?>