<?php
ini_set('display_errors', 1);
session_start();

use App\config\Router;

require_once "vendor/autoload.php";
require_once "technical/Env.php";

$router = new Router();
$router->dispatch($_SERVER['REQUEST_URI']);
