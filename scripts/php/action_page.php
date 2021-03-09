<?php 

namespace application;
include 'ResultModel.php';

session_start();

// get the q parameter from URL
$login = $_REQUEST["login"];
$email = $_REQUEST["email"];
$password = $_REQUEST["psw"];

$myObj = new ResultModel($login, $email, $password);
$myObj->setError(false);

$myJSON = json_encode($myObj);

echo $myJSON;


?>