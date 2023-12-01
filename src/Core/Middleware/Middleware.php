<?php

namespace Core\Middleware;

class Middleware
{
    public const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    public static function resolve($key){
        // no key->return
        if(!$key){
            return;
        }
        // find middleware
        $middleware = static::MAP[$key]??false;
        // no middleware -> err
        if(!$middleware){
            throw new \Exception("No matching middleware found for key '{$key}'.");
        }
        // has middleware -> handle
        (new $middleware)->handle();
    }



}
