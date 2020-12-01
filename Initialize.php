<?php

//https://stackoverflow.com/questions/85816/how-can-i-force-users-to-access-my-page-over-https-instead-of-http?noredirect=1&lq=1
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

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