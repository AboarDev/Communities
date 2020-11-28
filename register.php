<?php
require_once "Controller.php";

$username = $_REQUEST["username"];

$password = $_REQUEST["password"];

$hash = password_hash($password, PASSWORD_DEFAULT);

$controller = new Controller(false);

$controller->connect();

$controller->register($username,$hash);

echo "Registered Account <a href=\"index.php\">Go Back</a>";