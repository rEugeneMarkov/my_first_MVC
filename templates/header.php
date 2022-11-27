<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    //require $_SERVER['DOCUMENT_ROOT'] . "/pages/login.php"; // вот так работает
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
    <meta charset="utf-8">  
        <title>Гостевая книга</title>
        <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
    <div id="wrapper">
<header>
<?php
    require $_SERVER['DOCUMENT_ROOT'] . "/pages/config.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/pages/login.php";
?>
    <a href="/">Главная</a> |
    <a href="/articles">Статьи</a> |
    <a href="/registration">Регистрация</a> |
    <a href="/test">Тест</a> |
</header> 
