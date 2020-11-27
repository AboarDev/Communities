<?php
require_once "Controller.php";

$controller = new Controller(false);

$controller->connect();

$controller->logout();

echo "Logged Out <a href=\"index.php\">Go Back</a>";