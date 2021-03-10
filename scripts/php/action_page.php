<?php 

namespace application;

use PDOException;

session_start();

include 'ResultModel.php';
include 'DAO.php';

// get the q parameter from URL
$login = $_REQUEST["login"];
$email = $_REQUEST["email"];
$password = $_REQUEST["psw"];

$myObj = new ResultModel($login, $email, $password);
$myObj->setHasError(false);

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

$myJSON = json_encode($myObj);

echo $myJSON;
