<?php
require_once "Controller.php";
require_once "config.php";
require_once "SimpleDisplayable.php";

$config = new Config();
$data = $config->getConfig();
$DBName = $config->getDBName();

$goBack = $data["back"] ?? '';
$success = $data["success"] ?? '';

$display = new SimpleDisplayable([],false);

$controller = new Controller($display,$DBName);
$controller->connect();
$controller->logout();

echo "$success <a href=\"index.php\">$goBack</a>";