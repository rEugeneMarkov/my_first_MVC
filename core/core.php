<?php

// Загрузка классов "на лету"

spl_autoload_register(function ($class_name) {
    $a = str_replace('\\', '/', $class_name);
    $file = SITE_PATH . $a . '.php';
    require $file;
});
