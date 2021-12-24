<?php


return [
    'default' => 'mysql',
    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', " "),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],


        'mysql' => [
            'driver' => env("MYSQL_ROOT_DRIVER", "mysql"),
            'host' => env('PMA_HOST', '127.0.0.1'),
            'database' => env('MYSQL_DATABASE', 'homestead'),
            'username' => env('MYSQL_USER', 'homestead'),
            'password' => env('MYSQL_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,

        ]
    ],

];
