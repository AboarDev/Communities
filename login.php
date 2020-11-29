<?php
require_once "Controller.php";
require_once "config.php";
require_once "SimpleDisplayable.php";

$username = $_REQUEST["username"];
$password = $_REQUEST["password"];

$config = new Config();
$data = $config->getConfig();
$DBName = $config->getDBName();

$goBack = $data["back"] ?? '';
$success = $data["success"] ?? '';
$failed = $data["failed"] ?? '';

$display = new SimpleDisplayable($data,false);

$controller = new Controller($display,$DBName);
$controller->connect();

if($controller->login($username,$password)){
    $display->data["taskSuccess"] = true;
    $controller->display();
} else {
    $display->data["taskSuccess"] = false;
    $controller->display();
}