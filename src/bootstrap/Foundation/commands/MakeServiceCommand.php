<?php

namespace Src\Bootstrap\Foundation\Commands;

class MakeServiceCommand extends MakeScaffoldCommand
{
    /**
     * Define console command name
     * php slim make:command
     */
    protected $name = 'make:service';
    protected $help = 'scaffold a service';
    protected $description = 'A service will be make in the services folder';

    protected function arguments()
    {
        return [
            'name' => $this->require('MakeServiceCommand name command description'),
        ];
    }
}
