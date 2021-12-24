<?php

namespace Src\Bootstrap\Foundation\Commands;

class MakeRepositoryCommand extends MakeScaffoldCommand
{
    /**
     * Define console command name
     * php slim make:command
     */
    protected $name = 'make:repository';
    protected $help = 'Scaffold Eloquent Repository';
    protected $description = 'Generate a repository';

    protected function arguments()
    {
        return [
            'name' => $this->require('MakeRepositoryCommand.php name command description'),
        ];
    }
}
