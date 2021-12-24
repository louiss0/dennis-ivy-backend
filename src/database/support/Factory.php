<?php


class Factory
{



    public static $definitions = [];


    public function __invoke(string| object $model, $count = 1)
    {
        # code...


        $this->loadFactoryFor($model);

        array_push(static::$definitions, $model);

        return FactoryMakeOrCreate::options(
            $model,
            $count,
            static::$definitions[$model]
        );
    }



    public function loadFactoryFor(string| object $model)
    {
        # code...

        $name = class_basename($model);

        $factory = "{$name}Factory";


        require_once database_path("factories/{$factory}.php");
    }

    public static function define(string| object $model, callable $callback)
    {
        # code...

        static::$definitions[$model] = $callback;


        return new static;
    }
}
