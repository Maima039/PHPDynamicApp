<?php

session_start();

// why put index in public folder? 
// otherwise router.php can be get from url !

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {
    $class = str_replace('\\',DIRECTORY_SEPARATOR, $class);
    require base_path("{$class}.php");
});
require base_path('bootstrap.php');
$router = new \Core\Router();
$routes = require('../routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$router->route($uri, $method);
