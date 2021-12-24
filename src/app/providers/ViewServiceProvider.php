<?php

namespace Src\App\Providers;

use DI\Container;
use Slim\Psr7\Factory\ResponseFactory;
use Src\Utils\Classes\View;

/**
 * Register Service Provider To Application within config/app.php
 */
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register ServiceProvider Hooks Run First
     */
    public function register()
    {
        //

        $this->bindToContainer(View::class, fn (Container $container) => new View(
            $container->get(ResponseFactory::class)
        ));
    }

    /**
     * After all register ServiceProviders Hooks complete, then
     * all boot ServiceProvider Hooks are executed
     */
    public function boot()
    {
        //
    }
}
