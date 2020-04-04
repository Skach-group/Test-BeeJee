<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function autoload(string $className){
    require_once __DIR__.'/../'.str_replace('\\', '/', $className).'.php';
}
spl_autoload_register('autoload');
define('APPPATH', realpath(dirname(__FILE__)));
session_start();
$app = new App\Controllers\Router();
$app->getRout();









