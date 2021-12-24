<?php

namespace Src\Bootstrap\Foundation\Commands;

use Symfony\Component\Console\Input\InputOption;

class MakeMiddlewareCommand extends MakeScaffoldCommand
{
    protected $name = 'make:middleware';
    protected $help = 'Scaffold Http Middleware';
    protected $description = 'Generate or make Scaffold for new http middleware class';

    protected function arguments()
    {
        return [
            'name' => $this->require('Make Middleware Class Name'),
        ];
    }


    public function configure()
    {
        # code...
        parent::configure();

        $this->addOption(
            name: "class",
            shortcut: "c",
            mode: InputOption::VALUE_NONE,
            description: "This will allow you to put middleware in the class folder"
        );

        $this->addOption(
            name: "attribute",
            shortcut: "a",
            mode: InputOption::VALUE_NONE,
            description: "This will allow you to put middleware in the attribute folder"
        );
    }

    public function handler()
    {
        $file = $this->scaffold(
            $this->stub('file'),
            $this->stub('replace.file')
        );

        $content = $this->scaffold(
            $this->stub('content'),
            $this->stub('replace.content')
        );


        $path = "{$this->stub('make_path')}/classes/{$file}";


        ["attribute" => $attribute, "class" => $class] = $this->getInput()->getOptions();



        if ($attribute && $class) {
            # code...


            $status = $this->files->put(
                "{$this->stub('make_path')}/attributes/{$file}",
                $this->scaffold(
                    stub: $this->stub('content'),
                    search_and_replace: $this->stub('replace.content2')
                )
            );
            $status2 = $this->files->put($path, $content);

            return $this->info("Successfully Generated {$file}! (status: {$status} and {$status2})");
        } elseif ($attribute) {

            $path = "{$this->stub('make_path')}/attributes/{$file}";

            $content = $this->scaffold(
                stub: $this->stub('content'),
                search_and_replace: $this->stub('replace.content2')
            );
        }



        $exists = $this->files->exists($path);

        if ($exists) {
            return $this->error("{$file} already exists!");
        }

        $status = $this->files->put($path, $content);

        return $this->info("Successfully Generated {$file}! (status: {$status})");
    }
}
