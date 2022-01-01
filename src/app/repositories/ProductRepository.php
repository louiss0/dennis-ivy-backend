<?php

namespace Src\App\Repositories;

use Src\App\Models\Product;
use Src\Types\Interfaces\{IProductRepository};

class ProductRepository extends Repository implements IProductRepository
{



    function __construct(
        private Product $model
    ) {

        parent::__construct($this->model);
    }

    function getOne(int $id): Product
    {

        return parent::getOne($id);
    }

    function findOne(string $column, string|int $value, string $operator = "="): Product
    {
        return parent::findOne($column, $value, $operator);
    }

    function findMany(string $column, string|int $value, string $operator = "=")
    {
        return parent::findMany($column, $value, $operator);
    }
}
