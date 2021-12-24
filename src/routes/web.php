<?php

declare(strict_types=1);

use Src\App\Http\Controllers\AuthController;
use Louiss0\SlimRouteRegistry\RouteRegistry;
use Src\Utils\Classes\View;

RouteRegistry::get("/", function (View $view) {
    # code...


    return $view("home");
});


RouteRegistry::resources(
    ["path" => "", "resource" => AuthController::class],
);
