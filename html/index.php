<?php

session_start();

//подключение ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

const KEY = 'werVFSHbdjJDBjfdhfJHGDF12KJvfdyvBv';

// подключаем автозагрузчик Composer
include_once __DIR__ . '/../vendor/autoload.php';

//подключение файлов системы
define('ROOT', __DIR__ . '/../src');
include_once __DIR__ . '/../src/components/Autoload.php';

//установка соединения с бд

//Вызов Router
$router = new Router();
$router->run();
