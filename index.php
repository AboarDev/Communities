<?php
require_once "Controller.php";
require_once 'ViewSite.php';
require_once 'DisplayPost.php';
require_once 'config.php';
require_once 'HomePage.php';

$config = new Config();
$data = $config->getConfig();
$DBName = $config->getDBName();

$data["title"] = "Gaming Community";

$home = new HomePage($config->getConfig(),false);
$frame = new ViewSite($data,[$home]);

$controller = new Controller($frame,$DBName);
$controller->connect();

$postCallback = function($theData) use ($data){
    return new DisplayPost(array_merge($theData,$data),false);
};

$search = isset($_REQUEST["name"]);
if (!$search){
    $controller->getPosts($postCallback);
} else {
    $controller->getPostsByName($postCallback,$_REQUEST["name"]);
}

$loggedIn = $controller->verify();
$home->data["showLoginForm"] = $loggedIn;
$controller->display();