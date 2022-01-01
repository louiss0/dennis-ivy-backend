<?php

namespace Src\App\Providers;

use Src\App\Models\{
    Product,
    User
};
use Src\App\Repositories\{
    ProductRepository,
    UserRepository
};
use Src\Types\Interfaces\{
    IRepository,
    IUserRepository,
    IProductRepository
};

/**
 * Register Service Provider To Application within config/app.php
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register ServiceProvider Hooks Run First
     * 
     * 
     * 
     */


    public function getRepositories()
    {
        return [
            IUserRepository::class => new UserRepository(new User()),
            IProductRepository::class => new ProductRepository(new Product())
        ];
    }



    public function register()
    {

        $repositories = $this->getRepositories();
        array_walk(
            callback: fn (IRepository $value, string $key) =>
            $this->bindToContainer($key, fn () => $value),
            array: $repositories
        );
    }

    /**
     * After all register ServiceProviders Hooks complete, then
     * all boot ServiceProvider Hooks are executed
     */
    public function boot()
    {
        //
    }
}
