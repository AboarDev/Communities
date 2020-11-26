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

$controller->verify($username,$password);

if (true){
    session_start();
    session_destroy(); 
}