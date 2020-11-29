<?php

require_once 'ViewSite.php';
require_once "config.php";
require_once 'NewPost.php';

$config = new Config();

$data = $config->getConfig();

$DBName = $config->getDBName();

if (isset($_REQUEST["edit"])){
    $data["title"] = "New Post";
    $frame = new ViewSite($data,[]);
    
    require_once "Controller.php";
    $controller = new Controller($frame,$DBName);
    $controller->connect();
    $post = $controller->getPost($_REQUEST["id"]);

    $data["edit"] = true;
    $data["id"] = $_REQUEST["id"];
    $data["bodyText"] = $post["PostText"];
    $data["postTitle"] = $post["PostTitle"];

    $home = new NewPost($data,false);
    $frame->child[] = $home;

    $controller->display();
} else{
    $data["title"] = "New Post";
    $data["edit"] = false;

    $home = new NewPost($data,false);
    $frame = new ViewSite($data,[$home]);
    $frame->displayElement();
}