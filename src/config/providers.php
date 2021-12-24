<?php

use Src\App\Providers\CorsMiddlewareServiceProvider;
use Src\App\Providers\DatabaseServiceProvider;
use Src\App\Providers\RouteServiceProvider;
use Src\App\Providers\LoggerServiceProvider;
use Src\App\Providers\ViewServiceProvider;

$providers = [
    LoggerServiceProvider::class,
    DatabaseServiceProvider::class,
    ViewServiceProvider::class,
    CorsMiddlewareServiceProvider::class,
    RouteServiceProvider::class,
];



return $providers;
