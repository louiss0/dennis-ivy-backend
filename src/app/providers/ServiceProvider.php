<?php

namespace Src\App\Providers;

use DI\Container;
use Slim\App;

abstract class ServiceProvider
{


    private Container $container;
    public function __construct(
        private App $app
    ) {

        # code...

        $this->container = $this->app->getContainer();
    }

    abstract function register();
    abstract function boot();


    public function bindToContainer(string $key, callable $callable)
    {
        # code...

        $this->container->set($key, $callable);
    }

    public function resolve(string $key)
    {
        # code...
        return $this->container->get($key);
    }

    final static function setup(App $app, array $providers)
    {


        $providers = array_map(
            fn (object | string $serviceProvider) =>
            new $serviceProvider($app),
            $providers
        );

        array_walk(
            $providers,
            fn (ServiceProvider $serviceProvider) => $serviceProvider->register()
        );


        array_walk(
            $providers,
            fn (ServiceProvider $serviceProvider) => $serviceProvider->boot()
        );
    }

    /**
     * Get the value of app
     */
    public function getApp()
    {
        return $this->app;
    }
}
