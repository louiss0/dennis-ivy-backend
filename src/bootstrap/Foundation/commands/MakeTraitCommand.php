<?php

namespace Src\Bootstrap\Foundation\Commands;

class MakeTraitCommand extends MakeScaffoldCommand
{
    /**
     * Define console command name
     * php slim make:command
     */
    protected $name = 'make:trait';
    protected $help = 'Generate a trait ';
    protected $description = 'This will scaffold a trait';

    protected function arguments()
    {
        return [
            'name' => $this->require('MakeTraitCommand name command description'),
        ];
    }
}
