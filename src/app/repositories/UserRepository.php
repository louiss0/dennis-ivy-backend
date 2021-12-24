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


        return $this->user_model
            ->query()
            ->where('email', $email)
            ->first();
    }


    public function getUserByPassword(string $password): ?User
    {
        # code...

        return $this->user_model
            ->query()
            ->where('password', $password)
            ->first();
    }


    public function getUserByResetToken(string $resetToken): ?User
    {
        return $this->user_model
            ->query()
            ->where('reset_token', $resetToken)
            ->first();
    }

    public function getUserById(string $id): ?User
    {
        return $this->user_model
            ->query()
            ->where('id', $id)
            ->first();
    }



    function deleteUserByEmail(string $email)
    {
        return $this->user_model
            ->query()
            ->where("email", $email)
            ->delete();
    }

    function forceDeleteUserById(string $id)
    {
        return $this->user_model
            ->query()
            ->where('id', $id)
            ->forceDelete();
    }
}
