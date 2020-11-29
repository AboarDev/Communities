<?php
require_once "Controller.php";
require_once "config.php";
require_once "SimpleDisplayable.php";
$config = new Config();
$data = $config->getConfig();
$DBName = $config->getDBName();

$display = new SimpleDisplayable([],false);

$controller = new Controller($display,$DBName);
$controller->initializeDB();

echo "Made DB Tables";