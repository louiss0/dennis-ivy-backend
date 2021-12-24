<?php


namespace Src\Utils\Classes;

use Louiss0\SlimRouteRegistry\RouteRegistry;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface;
use Slim\Routing\RouteCollectorProxy;

class RouteGroup
{


    private string $prefix;

    private string $routesFile;

    private array $middleware;

    public function __construct(
        private RouteCollectorProxyInterface | App $app,

    ) {
    }

    /**
     * Set the value of routesFile
     *
     * @return  self
     */
    public function setRoutesFile(string $routesFile)
    {
        $this->routesFile = $routesFile;

        return $this;
    }

    /**
     * Get the value of middleware
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

    /**
     * Set the value of middleware
     *
     * @return  self
     */
    public function setMiddleware(array $middleware)
    {
        $this->middleware = $middleware;

        return $this;
    }

    /**
     * Set the value of prefix
     *
     * @return  self
     */
    public function setPrefix(string $prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }



    public function register()
    {
        # code...

        $group = $this->app->group($this->prefix, function (RouteCollectorProxy $group) {
            # code...

            RouteRegistry::setup($group);

            require $this->routesFile;
        });

        array_walk(
            $this->middleware,
            fn ($middleware) => $group->add(new $middleware)
        );
    }
}
