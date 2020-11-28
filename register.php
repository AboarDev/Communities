<?php
require_once "Controller.php";
require_once "config.php";

$username = $_REQUEST["username"];

$password = $_REQUEST["password"];

$hash = password_hash($password, PASSWORD_DEFAULT);

$config = new Config();

$data = $config->getConfig();

$goBack = $data["back"] ?? '';

$success = $data["success"] ?? '';

$controller = new Controller(false);

$controller->connect();

$controller->register($username,$hash);

echo "$success <a href=\"index.php\">$goBack</a>";