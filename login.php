<?php
require_once "Controller.php";

//echo var_dump($_REQUEST);

$username = $_REQUEST["username"];

$password = $_REQUEST["password"];

//$hash = password_hash($password, PASSWORD_DEFAULT);
//echo $hash;

//echo password_verify($password,$hash);

$controller = new Controller(false);

$controller->connect();

$controller->login($username,$password);

$controller->verify();
/* 
if ($loginSuccessful){
    session_start();
    $_SESSION['signedIn'] = true;
    session_write_close();
} */