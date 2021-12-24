<?php

namespace Src\App\Kernels;

use Slim\App;
use Src\Bootstrap\Foundation\Bootstrappers\Bootstrapper;
use Src\Bootstrap\Foundation\Bootstrappers\LoadDebuggingPage;
use Src\Bootstrap\Foundation\Bootstrappers\LoadHttpMiddleware;
use Src\Bootstrap\Foundation\Bootstrappers\LoadServiceProviders;
use Src\App\Providers\ServiceProvider;

abstract class Kernel
{


    /** 
     *  @var ServiceProvider[]
      
     */
    protected $bootstrap = [
        LoadDebuggingPage::class,
        LoadHttpMiddleware::class,
        LoadServiceProviders::class,
    ];


    public function __construct(

        private App $app
    ) {

        $this->app->getContainer()->set(self::class, $this);

        Bootstrapper::setup($this->app, $this->bootstrap);
    }


    static function bootstrap(App $app)
    {
        # code...

        return new static($app);
    }

    /**
     * Get the value of app
     */
    public function getApp()
    {
        return $this->app;
    }
}
