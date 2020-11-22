<?php

require_once "Controller.php";

echo var_dump ($_REQUEST);

$title = $_REQUEST["title"];

$text = $_REQUEST["posttext"];

$controller = new Controller(1);

$controller->addPost($title,$text);

?>