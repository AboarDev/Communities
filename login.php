<?php
require_once "Controller.php";

$username = $_REQUEST["username"];

$password = $_REQUEST["password"];

$controller = new Controller(false);

$controller->connect();

if($controller->login($username,$password)){
    echo "Logged In <a href=\"index.php\">Go Back</a>";
} else {
    echo "Failed to log in <a href=\"index.php\">Go Back</a>";
}

//$controller->verify();
/* 
if ($loginSuccessful){
    session_start();
    $_SESSION['signedIn'] = true;
    session_write_close();
} */