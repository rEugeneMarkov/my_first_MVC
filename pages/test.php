<?php

require $_SERVER['DOCUMENT_ROOT'] . "/templates/header.php";
spl_autoload_register(function ($class_name) {
    $a = explode('\\', $class_name);
    $last = array_pop($a);
    $fn = $last . '.php';
    require $fn;
});

$email = $_SESSION['email'] ?? '';
$userdata = get_user($email);

$user = new \First\User($userdata['name'], $userdata['email'], $userdata['pass']);
//$user->name = $userdata['name'];
//echo $user->getUserName();
$user->hello();
echo $user->getInfo();
echo $user->name;
