<?php

use Src\App\Http\Controllers\{
    ProductsController,
    UserController,
};
use Src\Types\Enums\Paths;
use Louiss0\SlimRouteRegistry\RouteRegistry;

RouteRegistry::group(Paths::VERSION_ONE, function () {
    # code...

    RouteRegistry::resources(
        ["path" => "/users", "resource" => UserController::class],
        ["path" => "/products", "resource" => ProductsController::class],
    );
});
