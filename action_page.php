<?php 
session_start();

// get the q parameter from URL
$login = $_REQUEST["login"];
$email = $_REQUEST["email"];
$password = $_REQUEST["psw"];

echo $login;


?>