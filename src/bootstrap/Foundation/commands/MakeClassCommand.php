<?php

namespace Src\Bootstrap\Foundation\Commands;

class MakeClassCommand extends MakeScaffoldCommand
{
    /**
     * Define console command name
     * php slim make:command
     */
    protected $name = 'make:class';
    protected $help = 'create a fresh class';
    protected $description = 'this will make a class scaffold in ';

    protected function arguments()
    {
        return [
            'name' => $this->require('MakeClassCommand name command description'),
        ];
    }
}
