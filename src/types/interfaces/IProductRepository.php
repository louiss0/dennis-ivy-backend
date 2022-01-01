<?php



namespace Src\Types\Interfaces;

use Src\App\Models\Product;
use Src\Types\Interfaces\IRepository;

interface IProductRepository extends IRepository
{


    /** @return Product[]  */
    public function getAll();

    public function getOne(int $id): Product;


    public function findOne(string $column, string| int $value, string $operator): Product;

    /**  @return Product[]  */
    public function findMany(string $column, string| int $value, string $operator);
}
