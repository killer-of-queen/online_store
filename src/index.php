<?php

session_start();

//подключение ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

//подключение файлов системы
define('ROOT', dirname(__FILE__));
include_once (ROOT.'/components/Autoload.php');

//установка соединения с бд

//Вызов Router
$router = new Router();
$router->run();
