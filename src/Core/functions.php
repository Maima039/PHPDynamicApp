<?php

use Core\Response;

// used for inspection/debug
function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}
// for check nav menu
function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

// check if authorized

function abort($code = 404)
{
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}

// acquire path
function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    // extract: Import variables from an array into the current symbol table.
    extract($attributes);
    require base_path('views/' . $path);
}

function redirect($path)
{
    header("location: {$path}");
    exit();
}

function old($key, $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}
