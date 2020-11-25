<?php
require_once "Controller.php";
$controller = new Controller(false);
$controller->initializeDB();
echo "Made DB Tables";