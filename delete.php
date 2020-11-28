<?php
require_once "Controller.php";
require_once "config.php";


$id = $_REQUEST["id"];

$config = new Config();

$data = $config->getConfig();

$goBack = $data["back"] ?? '';

$success = $data["success"] ?? '';

$failed = $data["failed"] ?? '';

$controller = new Controller(false);

$controller->connect();

if($controller->verify()){
    $controller->deletePost($id);
    echo "$success <a href=\"index.php\">$goBack</a>";
} else {
    echo "$failed <a href=\"index.php\">$goBack</a>";
}