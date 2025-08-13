<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Routing\Controllers\HasMiddleware;

abstract class Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            Authenticate::class
        ];
    }
}
