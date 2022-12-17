<?php

//define('DIRSEP', DIRECTORY_SEPARATOR);

error_reporting(E_ALL);

if (version_compare(phpversion(), '5.1.0', '<') == true) {
    die('PHP5.1 Only');
}

// Константы:




// Узнаём путь до файлов сайта

//$site_path = realpath(dirname(__FILE__) . DIRSEP . '..' . DIRSEP) . DIRSEP;

//define('site_path', $site_path);

// Загрузка классов «на лету»

spl_autoload_register(function ($class_name) {
    $filename = strtolower($class_name) . '.php';

    $file = $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $filename;


    if (file_exists($file) == false) {
        return false;
    }

    include($file);
})

$registry = new registry();
