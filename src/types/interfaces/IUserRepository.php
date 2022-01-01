<?php


namespace Src\Types\Interfaces;

use Src\App\Models\User;

interface IUserRepository extends IRepository
{

    public function getUserByEmail(string $email): ?User;
    public function getOne(int $id): ?User;

    /** @return User[]  */
    public function findMany(string $column, string |int $value, string $operator = "");
    public function findOne(string $column, string | int $value, string $operator = ""): ?User;
    public function getUserByNameAndEmail(string $name, string $email): ?User;
    public function deleteUserByEmail(string $email);
    public function forceDeleteUserById(string $id);
    public function getUserByPassword(string $password): ?User;
    public function getUserByResetToken(string $resetToken): ?User;
}
