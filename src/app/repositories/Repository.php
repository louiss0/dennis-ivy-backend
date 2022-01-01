<?php

namespace Src\App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Src\Types\Interfaces\IRepository;
use Src\Utils\Classes\ApiFeatures;

abstract class Repository  implements IRepository
{


    function save(): void
    {
        $this->model->save();
    }
    public function __construct(
        private Model $model
    ) {
    }

    public function getAll()
    {
        # code...

        return $this->model->all();
    }

    function findOne(string $column, string|int $value, string $operator = "=")
    {
        return $this->model->query()->where($column, $operator, $value)->first();
    }


    function findMany(string $column, string|int $value, string $operator = "=")
    {
        return $this->model->query()->where($column, $operator, $value)->get();
    }

    public function getAllBasedOnQueryParameters(array $query_array): array
    {


        $features = new ApiFeatures($this->model->query(), $query_array);;
        return $features
            ->filter()
            ->sort()
            ->limit()
            ->paginate()
            ->getQuery()
            ->get()
            ->all();
    }


    public function getOne(int $id)
    {
        # code...

        return $this->model
            ->query()
            ->where("id", $id)
            ->first();
    }
    public function createOne(array $data)
    {

        return $this->model->create($data)->toArray();
    }


    public function createMany(array $values)
    {

        return $this->model->createMany($values);
    }

    function deleteMany(array $values)
    {


        return $this->model->destroy($values);
    }

    public function deleteOne(int $id)
    {
        return $this->model
            ->query()
            ->where("id", $id)
            ->delete();
    }
}
