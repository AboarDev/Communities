<?php
require_once "Controller.php";
require_once "config.php";
$config = new Config();
$data = $config->getConfig();
$DBName = $config->getDBName();

$controller = new Controller(false,$DBName);
$controller->initializeDB();

echo "Made DB Tables";