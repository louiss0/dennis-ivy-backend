<?php

use Faker\Factory;
use Illuminate\Support\Collection;

final class FactoryMakeOrCreate
{
    private function __construct(
        private string $model,
        private int $count,
        private Closure $default_attributes,
    ) {
    }

    /**
     * Get the value of model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get the value of count
     */
    public function getCount()
    {
        return $this->count;
    }




    public function create($attributes = []): Collection
    {
        [$model, $default_attributes, $created] = [
            $this->model,
            $this->getDefaultAttributes(),
            collect([])
        ];


        for ($i = 1; $i <= $this->getCount(); $i++) {


            $created->push(
                $model::forceCreate(
                    array_merge($default_attributes(Factory::create()), $attributes)
                )
            );
        }

        return $created;
    }

    public function make($attributes = []): Collection
    {

        [$model, $default_attributes, $made] = [
            $this->getModel(),
            $this->getDefaultAttributes(),
            collect([])
        ];


        for ($i = 1; $i <= $this->getCount(); $i++) {


            $made->push(
                $model::make(
                    array_merge($default_attributes(Factory::create()), $attributes)
                )
            );
        }

        return $made;
    }

    static  public function options(...$arguments)
    {
        return new static(...$arguments);
    }

    /**
     * Get the value of default_attributes
     */
    public function getDefaultAttributes()
    {
        return $this->default_attributes;
    }
}
