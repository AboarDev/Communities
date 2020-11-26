<?php

require_once "Controller.php";
require_once 'ViewSite.php';

$title = $_REQUEST["title"];

$text = $_REQUEST["posttext"];

$controller = new Controller(1);

$controller->connect();

if (strlen($title) > 0){
    $controller->addPost($title,$text);
    
    echo "Made Post <a href=\"_index.php\">Go Back</a>";
}


?>