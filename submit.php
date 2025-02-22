<?php
namespace Communities;
//https://stackoverflow.com/questions/85816/how-can-i-force-users-to-access-my-page-over-https-instead-of-http?noredirect=1&lq=1
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

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
    if ($controller->editPost($id,$title,$text)){
        $display->data["taskSuccess"] = true;
        $controller->display();
    } else {
        $display->data["taskSuccess"] = false;
        $controller->display();
    }
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