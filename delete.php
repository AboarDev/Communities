<?php
require_once "Controller.php";

$id = $_REQUEST["id"];

$controller = new Controller(false);

$controller->connect();

if($controller->verify()){
    $controller->deletePost($id);
    echo "Deleted Post <a href=\"index.php\">Go Back</a>";
} else {
    echo "Failed to delete post <a href=\"index.php\">Go Back</a>";
}