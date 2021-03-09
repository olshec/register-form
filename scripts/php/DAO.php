<?php

namespace application;

use PDO;

class DAO 
{
    private $servername;
    private $username;
    private $password;
    private $database;
    
    function __construct($servername, $username, $password) {
        $this->setServername($servername);
        $this->setUsername($username);
        $this->setPassword($password);
    }
    
    public function getPDO():PDO {
        echo $this->getUsername();
        echo $this->getPassword();
        $pdo = new PDO("pgsql:host=$this->servername;dbname=$this->database", 
            $this->username, $this->password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    
    /**
     * @return string
     */
    public function getServername()
    {
        return $this->servername;
    }
    
    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @return mixed
     */
    public function getDatabase()
    {
        return $this->database;
    }
    
    /**
     * @param string $servername
     */
    public function setServername($servername)
    {
        $this->servername = $servername;
    }
    
    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    /**
     * @param mixed $database
     */
    public function setDatabase($database)
    {
        $this->$database = $database;
    }
}

?>