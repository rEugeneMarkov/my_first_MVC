<?php

$mysql = new mysqli("mysql", "root", "root", "php-first-mySQL");
$mysql->query("SET NAMES'utf8'");
require $_SERVER['DOCUMENT_ROOT'] . "/pages/function.php";
