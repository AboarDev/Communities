<?php
require_once "Controller.php";
$config = new Config();
$data = $config->getConfig();
$DBName = $config->getDBName();

$controller = new Controller(false,$DBName);
$controller->initializeDB();

echo "Made DB Tables";