<?php

require $_SERVER['DOCUMENT_ROOT'] . "/templates/header.php";

require 'test2.php';
//require 'config.php';

    $email = $_SESSION['email'] ?? '';
    $userdata = get_user($email);
$user = new \First\User($userdata['name'], $userdata['email'], $userdata['pass']);
//$user->name = $userdata['name'];
//echo $user->getUserName();
$user->hello();
echo $user->getInfo();
echo $user->name;
