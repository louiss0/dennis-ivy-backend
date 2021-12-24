<?php

namespace Src\Bootstrap\Foundation\Commands;

class MakeInterfaceCommand extends MakeScaffoldCommand
{
    /**
     * Define console command name
     * php slim make:command
     */
    protected $name = 'make:interface';
    protected $help = 'scaffold a interface ';
    protected $description = 'make a interface in the interfaces folder';

    protected function arguments()
    {
        return [
            'name' => $this->require('MakeInterfaceCommand name command description'),
        ];
    }
}
