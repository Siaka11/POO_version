<?php

use App\Autoloader;
use App\Core\Main;
use App\Core\Router;
use App\Models\Model;

//define('ROOT', dirname(__DIR__));
//require_once "../vendor/autoload.php";
require_once "../Autoloader.php";
Autoloader::register();


$main = new Main();
$main->start();


echo "Bonjour tout le monde";