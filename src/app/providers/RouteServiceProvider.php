<?php

declare(strict_types=1);

namespace Src\App\Providers;

use Src\Utils\Classes\RouteGroup;
use Louiss0\SlimRouteRegistry\RouteRegistry;

class RouteServiceProvider extends ServiceProvider
{


    public function register()
    {
        RouteRegistry::setup($this->getApp());

        $this->bindToContainer(RouteGroup::class, function () {

            return new RouteGroup($this->getApp());
        });
    }


    public function boot()
    {

        $this->webRouteGroup()->register();
        $this->apiRouteGroup()->register();
    }


    public function webRouteGroup(): RouteGroup
    {
        # code...
        $web_routes = routes_path("web.php");


        ["web" => $web, "global" => $global] = $this->resolve("middleware");

        $web_group = $this->resolve(RouteGroup::class);

        $web_group
            ->setRoutesFile($web_routes)
            ->setPrefix("")
            ->setMiddleware([
                ...$web,
                ...$global,
            ]);

        return $web_group;
    }

    public function apiRouteGroup(): RouteGroup
    {
        # code...
        $api_routes = routes_path("api.php");

        ["api" => $api, "global" => $global] = $this->resolve("middleware");


        $api_group = $this->resolve(RouteGroup::class);

        $api_group
            ->setRoutesFile($api_routes)
            ->setPrefix("/api")
            ->setMiddleware([
                ...$api,
                ...$global,
            ]);

        return $api_group;
    }
}
