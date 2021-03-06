<?php 

namespace application;

use PDOException;

session_start();

include 'ResultModel.php';
include 'DAO.php';

// get the parameters from URL
$login = $_REQUEST["login"];
$password = $_REQUEST["psw"];
$typeForm = $_REQUEST["type-form"];

$myObj = new ResultModel();
$myObj->setHasError(false);

if(!preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*.)\S*$/',$password)) {
    $myObj->setHasError(true);
    $myObj->addError('The password is not in the correct format', 'login');
    $myJSON = json_encode($myObj);
    echo $myJSON;
    exit();
} else if (!preg_match("/^\S*(?=\S{5,20})[a-zA-Z]+[0-9]*\S*$/",$login)) {
    $myObj->setHasError(true);
    $myObj->addError('The login is not in the correct format', 'login');
    $myJSON = json_encode($myObj);
    echo $myJSON;
    exit();
} 

if($typeForm == 'register') {
    $email = $_REQUEST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $myObj->setHasError(true);
        $myObj->addError('The email is not in the correct format', 'email');
        $myJSON = json_encode($myObj);
        echo $myJSON;
        exit();
    }
    try {
        $dao = new DAO("localhost", 'postgres', '1111', 'db5');
        $pdo = $dao->getPDO();
        $stmt = $pdo->query('SELECT name, email FROM users');
        while ($row = $stmt->fetch())
        {
            if ($row['name'] == $login) {
                $myObj->setHasError(true);
                $myObj->addError('This login already exists', 'login');
            }
            if ($row['email'] == $email) {
                $myObj->setHasError(true);
                $myObj->addError('This email already exists', 'email');
            }
        }
        
        if($myObj->getHasError() == false) {
            $sql = "INSERT INTO users (name, email, password)
            VALUES (:name, :email, :password)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$login, $email, $password]);
            
            $myObj->setTextMessage('Register succesfull!');
        }
    } catch(PDOException $e) {
        $myObj->setHasError(true);
        $myObj->addError("Connection failed: " . $e->getMessage(), 'connection');
    }
    
} else if($typeForm == 'sign-in') {
    try {
        $dao = new DAO("localhost", 'postgres', '1111', 'db5');
        $pdo = $dao->getPDO();
        $sql = 'SELECT name, password
                FROM users
                WHERE name=:name AND password=:password';
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$login, $password]);
        $row = $stmt->fetch();
        if ($row['name'] == $login && $row['password'] == $password) {
            $myObj->setTextMessage('You are in your account!');
        } else {
            $myObj->setHasError(true);
            $myObj->addError('Wrong password or login.', 'sign-in');
        }
    } catch(PDOException $e) {
        $myObj->setHasError(true);
        $myObj->addError("Connection failed: " . $e->getMessage(), 'connection');
    }
}

$myJSON = json_encode($myObj);

echo $myJSON;

