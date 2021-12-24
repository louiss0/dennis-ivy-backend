<?php

namespace Src\App\Providers;

use Illuminate\Database\Capsule\Manager as DB;

class DatabaseServiceProvider extends ServiceProvider
{


    public function register()
    {

        [
            "connections" => ["mysql" => $mysql]

        ] = require_once config_path("database.php");


        $capsule = new DB;
        $capsule->addConnection($mysql);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }


    public function boot()
    {
        # code...
    }
}
