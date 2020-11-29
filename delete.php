<?php
require_once "Controller.php";
require_once "config.php";
require_once "SimpleDisplayable.php";

$id = $_REQUEST["id"];

$config = new Config();
$data = $config->getConfig();
$DBName = $config->getDBName();

$goBack = $data["back"] ?? '';
$success = $data["success"] ?? '';
$failed = $data["failed"] ?? '';

$display = new SimpleDisplayable($data,false);

$controller = new Controller($display,$DBName);
$controller->connect();

if ($controller->deletePost($id)){
    $display->data["taskSuccess"] = true;
    $controller->display();
} else {
    $display->data["taskSuccess"] = false;
    $controller->display();
}