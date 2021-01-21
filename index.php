<?php
// Данный файл является фронт-контроллером

// Общие настройки
// Можно включить отображение ошибок, запустить сессию при наличии систем авторизации (здесь не нужно)

define('ROOT', __DIR__);
define('VIEWS', ROOT . "/views/");


ini_set('Display errors', 1);
error_reporting(E_ALL);

// session_start();

require_once ROOT."\components\Autoload.php";

$router = new Router();
$router->run();

 ?>
