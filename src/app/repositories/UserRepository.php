<?php


namespace Src\App\Repositories;

use Src\Types\Interfaces\IUserRepository;
use Src\App\Models\User;

class UserRepository extends Repository implements IUserRepository
{
    public function __construct(
        private User $user_model
    ) {

        parent::__construct($this->user_model);
    }


    function getOne(int $id): ?User
    {
        return parent::getOne($id);
    }


    function findOne(string $column, string|int $value, string $operator = "="): ?User
    {
        return parent::findOne($column, $value, $operator);
    }



    /**  @return User[]  */
    function findMany(string $column, string|int $value, string $operator = "=")
    {
        return parent::findMany($column, $value, $operator);
    }


    public function getUserByNameAndEmail(string $name, string $email): ?User
    {
        return $this->user_model
            ->query()
            ->where('email', $email)
            ->where('name', $name)
            ->first();
    }


    public function getUserByEmail(string $email): ?User
    {


        return $this->findOne('email', $email);
    }


    public function getUserByPassword(string $password): ?User
    {
        # code...

        return $this->findOne('password', $password);
    }


    public function getUserByResetToken(string $resetToken): ?User
    {
        return $this->findOne('reset_token', $resetToken);
    }



    function deleteUserByEmail(string $email)
    {
        return $this->findOne("email", $email)->delete();
    }

    function forceDeleteUserById(string $id)
    {
        return $this->user_model
            ->query()
            ->where('id', $id)
            ->forceDelete();
    }
}
