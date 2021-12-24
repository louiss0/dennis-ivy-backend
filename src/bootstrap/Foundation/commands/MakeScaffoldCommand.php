<?php

namespace Src\Bootstrap\Foundation\Commands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

abstract class MakeScaffoldCommand extends Command
{
    protected $stub;
    protected $files;

    protected function scaffold($stub, $search_and_replace)
    {
        $bindings = function ($replace, $search) {

            if (!Str::of($replace)->contains([':', '*', ':'])) {
                return $replace;
            }

            $binding = Str::of($replace)->between(':', ':');

            if (Str::contains($search, '|')) {

                $filter = Str::of($search)->between('|', '}')->__toString();

                return Str::of($this->getInput()->getArgument($binding))->$filter()->__toString();
            }

            return $this->getInput()->getArgument($binding);
        };



        $resolved = collect($search_and_replace)->map($bindings);

        $searching = $resolved->keys();

        return $searching->reduce(
            fn ($stub, $search) => Str::of($stub)->replace($search, $resolved[$search]),
            $stub
        );
    }

    public function stub($key)
    {
        return data_get($this->stub, $key);
    }

    public function afterConfiguration()
    {
        $stub_config = require config_path("stubs.php");

        $this->stub = $stub_config[$this->getName()];
        $this->files = new Filesystem;
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

        $path = "{$this->stub('make_path')}/{$file}";

        $exists = $this->files->exists($path);

        if ($exists) {
            return $this->error("{$file} already exists!");
        }

        $status = $this->files->put($path, $content);

        return $this->info("Successfully Generated {$file}! (status: {$status})");
    }
}
