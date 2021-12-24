<?php

namespace Src\Bootstrap\Foundation\Commands;

use Illuminate\Filesystem\Filesystem;

class ClearLogsCommand extends Command
{
    /**
     * Define console command name
     * php slim make:command
     */
    protected $name = 'clear:logs';
    protected $help = 'Clear logs in logs file';
    protected $description = 'Delete all logs from the logs folder';



    public function handler()
    {
        $filesystem = new Filesystem;

        $path = storage_path("logs");


        throw_if(
            !$path,
            RuntimeException::class,
            "Views cache path not found",
        );


        collect($filesystem->glob("{$path}/*"))->each(
            fn ($cached_view) =>
            $filesystem->delete($cached_view),
        );

        $this->info("Cached Logs Cleared");  //
    }
}
