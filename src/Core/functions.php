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

function login($user)
{
    $_SESSION['user'] = [
        'email' => $user['email']

    ];

    session_regenerate_id(true);
}

function logout()
{
    $_SESSION = [];
    session_destroy();
    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}
