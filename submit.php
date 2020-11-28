<?php

require_once "Controller.php";
require_once 'ViewSite.php';

$title = $_REQUEST["title"];

$text = $_REQUEST["posttext"];

$edit = $_REQUEST["edit"] ?? false;

$id = $_REQUEST["id"] ?? null;

$controller = new Controller(false);

$controller->connect();

if ($edit){
    $controller->verify();
    $post = $controller->getPost();
    echo $id;
} else {
    if (strlen($title) > 0){
        if ($controller->addPost($title,$text)){
            echo "Made Post <a href=\"index.php\">Go Back</a>";
        } else {
            echo "Failed to make post <a href=\"index.php\">Go Back</a>";
        }
    } else {
        echo "Failed to make post <a href=\"index.php\">Go Back</a>";
    } 
}
?>