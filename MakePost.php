<?php

require_once "Controller.php";
require_once 'ViewSite.php';

echo var_dump ($_REQUEST);

$title = $_REQUEST["title"];

$text = $_REQUEST["posttext"];

$controller = new Controller(1);

$controller->connect();

$controller->addPost($title,$text);

?>