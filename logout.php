<?php
require_once "Controller.php";
require_once "config.php";


$config = new Config();

$data = $config->getConfig();

$goBack = $data["back"] ?? '';

$controller = new Controller(false);

$controller->connect();

$controller->logout();

echo "Logged Out <a href=\"index.php\">$goBack</a>";