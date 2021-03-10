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
$myObj->setError(false);
$myObj->setTextMessage('Register succesfull!');

try {
    $dao = new DAO("localhost", 'postgres', '1111', 'db5');
    $pdo = $dao->getPDO();
    
    $stmt = $pdo->query('SELECT name, email FROM users');
    while ($row = $stmt->fetch())
    {
        if ($row['name'] == $login) {
            $myObj->setError(true);
            $myObj->setTextError('This name already exists');
            $myObj->setTypeError('name');
        } else if ($row['email'] == $email) {
            $myObj->setError(true);
            $myObj->setTextError('This email already exists');
            $myObj->setTypeError('email');
        }
    }
    
} catch(PDOException $e) {
    $myObj->setError(true);
    $myObj->setTextError("Connection failed: " . $e->getMessage());
    $myObj->setTypeError('connection');
}

$myJSON = json_encode($myObj);

echo $myJSON;


?>