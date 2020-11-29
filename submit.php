<?php
require_once "Controller.php";
require_once 'ViewSite.php';
require_once "config.php";

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

$controller = new Controller(false,$DBName);

$controller->connect();

if ($edit && $controller->verify()){
    $controller->editPost($id,$title,$text);
    echo "$success <a href=\"index.php\">$goBack</a>";
} else if (strlen($title) > 0){
    if ($controller->addPost($title,$text)){
        echo "$success <a href=\"index.php\">$goBack</a>";
    } else {
        echo "$failed <a href=\"index.php\">$goBack</a>";
    }
} else {
    echo "$failed <a href=\"index.php\">$goBack</a>";
}
?>