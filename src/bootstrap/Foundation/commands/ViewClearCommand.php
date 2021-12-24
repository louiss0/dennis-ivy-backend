<?php

namespace Src\Bootstrap\Foundation\Commands;

use Illuminate\Filesystem\Filesystem;
use RuntimeException;

class ViewClearCommand extends Command
{



    protected $name = "view:clear";
    protected $description = "Remove Cache for view templates";


    public function handler()
    {
        # code...

        $filesystem = new Filesystem;

        $path = storage_path("cache");


        throw_if(
            !$path,
            RuntimeException::class,
            "Views cache path not found",
        );



        collect($filesystem->glob("{$path}/*"))->each(
            fn ($cached_view) =>
            $filesystem->delete($cached_view)
        );

        $this->info("Cached Views Cleared");
    }
}
