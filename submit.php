<?php
require_once "Controller.php";
require_once 'ViewSite.php';
require_once "config.php";
require_once "SimpleDisplayable.php";

$title = $_REQUEST["title"];
$text = $_REQUEST["posttext"];
$edit = $_REQUEST["edit"] ?? false;
$id = $_REQUEST["id"] ?? null;

$config = new Config();
$data = $config->getConfig();
$DBName = $config->getDBName();

$goBack = $data["back"] ?? '';
$success = $data["success"] ?? '';
$failed = $data["failed"] ?? '';

$display = new SimpleDisplayable($data,false);

$controller = new Controller($display,$DBName);
$controller->connect();

if ($edit){
    $controller->editPost($id,$title,$text);
    $display->data["taskSuccess"] = true;
    $controller->display();
} else if (strlen($title) > 0){
    if ($controller->addPost($title,$text)){
        $display->data["taskSuccess"] = true;
        $controller->display();
    } else {
        $display->data["taskSuccess"] = false;
        $controller->display();
    }
} else {
    $display->data["taskSuccess"] = false;
    $controller->display();
}
?>