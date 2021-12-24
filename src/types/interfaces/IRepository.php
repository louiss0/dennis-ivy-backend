<?php

namespace Src\Types\Interfaces;

interface IRepository
{

    public function getAll();
    public function getOne(int $id);
    public function createOne(array $data);
    public function createMany(array $values);
    public function deleteMany(array $values);
    public function deleteOne(int $id);
}
