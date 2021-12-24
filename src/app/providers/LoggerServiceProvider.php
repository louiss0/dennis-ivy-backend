<?php

namespace Src\App\Providers;

use Monolog\Handler\StreamHandler;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Monolog\Processor\WebProcessor;
use Src\Types\Enums\MonoLoggers;

class LoggerServiceProvider extends ServiceProvider

{


    public function register()
    {
        # code...

        $logger = new Logger(MonoLoggers::REQUEST_LOGGER);

        $logger
            ->pushProcessor(new UidProcessor())
            ->pushProcessor(new WebProcessor($_SERVER))
            ->setHandlers(
                [
                    new ErrorLogHandler(),
                    new StreamHandler(
                        storage_path("logs/app-log.php")
                    ),
                ]
            );


        $this->bindToContainer(
            MonoLoggers::REQUEST_LOGGER,
            fn () => $logger
        );
    }

    public function boot()
    {
        # code...
    }
}
