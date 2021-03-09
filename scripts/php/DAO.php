<?php

namespace application;

use PDO;
use PDOException;

class DAO 
{
    private $servername = "localhost";
    private $username = "postgres";
    private $password = "1111";
    
    public function getPDO():PDO {
        $pdo = new PDO("pgsql:host=$this->servername;dbname=db5", 
            $this->username, $this->password);
        // set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        return $pdo;
    }

}

?>