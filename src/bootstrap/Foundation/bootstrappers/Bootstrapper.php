<?php


namespace Src\Bootstrap\Foundation\Bootstrappers;

use Slim\App;
use DI\Container;

class Bootstrapper
{

    private Container $container;

    private  final function __construct(
        protected App $app,
    ) {


        $this->container = $this->app->getContainer();
    }


    static function setup(App $app, array $loaders)
    {

        $loaders = array_map(fn (Bootstrapper | string $loader) => new $loader($app), $loaders);

        array_walk($loaders, fn (Bootstrapper $bootstrapper) => $bootstrapper->beforeBoot());


        array_walk($loaders, fn (Bootstrapper $bootstrapper) => $bootstrapper->boot());


        array_walk($loaders, fn (Bootstrapper $bootstrapper) => $bootstrapper->afterBoot());
    }

    public function boot()
    {
    }
    public function beforeBoot()
    {
        # code...
    }
    public function afterBoot()
    {
        # code...
    }

    /**
     * Get the value of container
     */
    public function getContainer()
    {
        return $this->container;
    }
}
