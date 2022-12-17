<?php

// включим отображение всех ошибок
error_reporting(E_ALL);
// подключаем конфиг
include('config.php');

// Соединяемся с БД
$dbObject = new PDO('mysql:host=mysql:3306;dbname=php-first-mySQL', 'root', 'root');
$dbObject->exec('SET CHARACTER SET utf8');

// подключаем ядро сайта
include(SITE_PATH . DS . 'core' . DS . 'core.php');


// Загружаем router
$router = new \classes\router($registry);
// записываем данные в реестр
$registry->set('router', $router);
// задаем путь до папки контроллеров.
$router->setPath(SITE_PATH . DS . 'controllers');
// запускаем маршрутизатор
$router->start();
