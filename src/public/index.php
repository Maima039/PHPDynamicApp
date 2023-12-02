<?php

use Core\Session;
use Core\ValidationException;

session_start();

// why put index in public folder? 
// otherwise router.php can be get from url !

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require base_path("{$class}.php");
});
require base_path('bootstrap.php');
$router = new \Core\Router();
$routes = require('../routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    // if fail, return to login page with errors
    Session::flash('errors', $exception->errors);
    // show email in new page
    Session::flash('old', $exception->old);
    return redirect($router->previousUrl());
}

// clear session upon refresh
Session::unflash();
