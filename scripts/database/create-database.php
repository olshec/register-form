<?php 

function getConnection($database = NULL) {
    $servername = "localhost";
    $username = "postgres";
    $password = "1111";
    if($database == NULL) {
        $conn = new PDO("pgsql:host=$servername;", $username, $password);
    } else {
        $conn = new PDO("pgsql:host=$servername;dbname=$database", 
            $username, $password);
    }
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function createDatabase($database) {
    try {
        $conn = getConnection();
        $sql = "CREATE DATABASE ".$database;
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Database created successfully\n";
        
        $conn = getConnection($database);
        
        $strCreateTableUsers = <<<EOD
            CREATE TABLE users (
            	name 		varchar(80) UNIQUE,
            	email 		varchar(50) UNIQUE,
            	password 	varchar(50)
            );
        EOD;
        $conn->exec($strCreateTableUsers);
        echo "Table users created successfully\n";
        
        $strRowsToTableUsers = <<<EOD
            INSERT INTO users VALUES
            	('user1', 'user1@gmail.com', '11112222Aa'),
            	('user2', 'user2@gmail.com', '12345678Zx'),
            	('user3', 'user3@gmail.com', '11111111XXc');
        EOD;
        $conn->exec($strRowsToTableUsers);
        echo "Rows has been into table users successfully\n";
        
    } catch(PDOException $e) {
        echo $e->getMessage()."\n";
    }
}


$database = "db5";
try {
    $conn = getConnection();
    $conn->exec('DROP DATABASE '.$database);
    echo "Drop database successfully\n";
    createDatabase($database);
} catch(PDOException $e) {
    createDatabase($database);
}



