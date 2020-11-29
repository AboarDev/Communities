<?php
require_once "Controller.php";
require_once "config.php";


$config = new Config();

$data = $config->getConfig();

$DBName = $config->getDBName();

$goBack = $data["back"] ?? '';

$success = $data["success"] ?? '';

$failed = $data["failed"] ?? '';

$controller = new Controller(false,$DBName);

$controller->connect();

$controller->logout();

echo "$success <a href=\"index.php\">$goBack</a>";