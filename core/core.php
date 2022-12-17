<?php

// Загрузка классов "на лету"

spl_autoload_register(function ($class_name) {
    $a = str_replace('\\', '/', $class_name);
    $file = SITE_PATH . $a . '.php';
    //$a = explode('\\', $class_name);
    //$last = array_pop($a);
    //$filename = $last . '.php';

    /*$expArr = explode('_', $last);
    if (empty($expArr[1]) or $expArr[1] == 'Base') {
        $folder = 'classes';
    } else {
        switch (strtolower($expArr[0])) {
            case 'controller':
                $folder = 'controllers';
                break;

            case 'model':
                $folder = 'models';
                break;

            default:
                $folder = 'classes';
                break;
        }
    }*/

    //$file = SITE_PATH . $folder . DS . $filename;
    require $file;
});

// запускаем реестр (хранилище)
$registry = new \classes\Registry();
