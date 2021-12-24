<?php


require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once base_path("bootstrap/app.php");

return [

    "paths" => [
        "migrations" => database_path("migrations"),
        "seeds" => database_path("seeders"),
    ],

    "environments" => [
        "default_migration_table" => "phinxlog",
        "default_database" => "slim",
        "slim" => [
            'adapter' => env("MYSQL_ROOT_DRIVER", "mysql"),
            'host' => env('PMA_HOST', '127.0.0.1'),
            'name' => env('MYSQL_DATABASE', 'homestead'),
            'user' => env('MYSQL_USER', 'homestead'),
            'pass' => env('MYSQL_PASSWORD', ''),
            'charset' => 'utf8',

        ],
    ],

];
