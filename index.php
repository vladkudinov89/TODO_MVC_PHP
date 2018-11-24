<?php

use Components\Router;

ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();


define('ROOT', dirname(__FILE__));

require ROOT . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$router = new Router();
$router->run();