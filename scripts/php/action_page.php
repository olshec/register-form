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

try {
    $dao = new DAO();
    $pdo = $dao->getPDO();
    $stmt = $pdo->query('SELECT name, email FROM users');
    while ($row = $stmt->fetch())
    {
        //echo $row['name'] . "\n";
        if ($row['name'] == $login) {
            $myObj->setError(true);
            $myObj->setTextError('This name already exists');
        } else if ($row['email'] == $email) {
            $myObj->setError(true);
            $myObj->setTextError('This email already exists');
        }
    }
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$myJSON = json_encode($myObj);

echo $myJSON;


?>