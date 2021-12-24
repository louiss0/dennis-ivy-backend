<?php


namespace Src\Bootstrap\Foundation\Bootstrappers;

use Src\App\Providers\ServiceProvider;

class LoadServiceProviders extends Bootstrapper
{

    public function boot()
    {
        $providers = require_once config_path("providers.php");

        ServiceProvider::setup($this->app, $providers);
        # code...
    }
}
