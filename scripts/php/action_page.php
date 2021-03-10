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

if($typeForm == 'register') {
    $email = $_REQUEST["email"];
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
        
        $stmt = $pdo->query('SELECT name, password FROM users');
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
