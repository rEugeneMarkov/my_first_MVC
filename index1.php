<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/') {
    $file = 'index.php';
} elseif ($uri === '/articles') {
    $file = 'articles.php';
} elseif ($uri === '/registration') {
    $file = 'registration.php';
} elseif ($uri === '/test') {
    $file = 'test.php';
} else {
    $file = 'error404.php';
}
require $_SERVER['DOCUMENT_ROOT'] . '/pages/' . $file;
