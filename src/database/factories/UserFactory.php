<?php

use Faker\Generator;
use Src\App\Models\User;

Factory::define(User::class, function (Generator $faker) {


    return [
        "name" => $faker->firstName(),
        "email" => $faker->unique()->email(),
        "password" => $faker->password(8),
        "created_at" => date("Y-m-d H:i:s"),
        "updated_at" => date("Y-m-d H:i:s"),

    ];
});
