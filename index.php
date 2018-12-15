<?php

use App\Components\Router;

ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

define('ROOT', dirname(__FILE__));

require ROOT . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

require 'app/config/database.php';

$router = new Router();
$router->run();