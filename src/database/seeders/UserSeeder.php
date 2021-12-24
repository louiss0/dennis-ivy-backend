`<?php


    use Phinx\Seed\AbstractSeed;
    use Src\App\Models\User;

    class UserSeeder extends AbstractSeed
    {

        /**
         * Run Method.
         *
         * Write your database seeder using this method.
         *
         * More information on writing seeders is available here:
         * https://book.cakephp.org/phinx/0/en/seeding.html
         */

        public function run()
        {

            $users = factory(User::class, 10)->create();


            $users->each(fn ($user) => var_dump($user));

            exit;
        }
    }
