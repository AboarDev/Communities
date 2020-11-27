<?php
require_once "Controller.php";

$controller = new Controller(false);

$controller->connect();

$controller->logout();