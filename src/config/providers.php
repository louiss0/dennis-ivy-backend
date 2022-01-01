<?php

use Src\App\Providers\{
    CorsMiddlewareServiceProvider,
    DatabaseServiceProvider,
    RouteServiceProvider,
    LoggerServiceProvider,
    RepositoryServiceProvider,
    ViewServiceProvider,
};

$providers = [
    LoggerServiceProvider::class,
    DatabaseServiceProvider::class,
    ViewServiceProvider::class,
    CorsMiddlewareServiceProvider::class,
    RouteServiceProvider::class,
    RepositoryServiceProvider::class,
];



return $providers;
