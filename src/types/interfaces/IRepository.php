<?php

namespace Src\Types\Interfaces;

interface IRepository
{

    public function getAll();
    public function getOne(int $id);
    public function createOne(array $data);
    public function findOne(string $column, string| int $value, string $operator);
    public function findMany(string $column, string| int $value, string $operator);
    public function createMany(array $values);
    public function getAllBasedOnQueryParameters(array $query_array): array;
    public function deleteMany(array $values);
    public function deleteOne(int $id);
    public function save(): void;
}
