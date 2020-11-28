<?php
require_once "Controller.php";
require_once "config.php";


$config = new Config();

$data = $config->getConfig();

$goBack = $data["back"] ?? '';

$success = $data["success"] ?? '';

$failed = $data["failed"] ?? '';

$controller = new Controller(false);

$controller->connect();

$controller->logout();

echo "$success <a href=\"index.php\">$goBack</a>";