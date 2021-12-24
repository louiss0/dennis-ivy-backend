<?php

namespace Src\App\Kernels;

use Src\Bootstrap\Foundation\Commands\ClearLogsCommand;
use Src\Bootstrap\Foundation\Commands\MakeAttributeCommand;
use Src\Bootstrap\Foundation\Commands\MakeClassCommand;
use Src\Bootstrap\Foundation\Commands\MakeCommandCommand;
use Src\Bootstrap\Foundation\Commands\MakeControllerCommand;
use Src\Bootstrap\Foundation\Commands\MakeInterfaceCommand;
use Src\Bootstrap\Foundation\Commands\MakeMiddlewareCommand;
use Src\Bootstrap\Foundation\Commands\MakeModelCommand;
use Src\Bootstrap\Foundation\Commands\MakeRepositoryCommand;
use Src\Bootstrap\Foundation\Commands\MakeServiceCommand;
use Src\Bootstrap\Foundation\Commands\MakeServiceProviderCommand;
use Src\Bootstrap\Foundation\Commands\MakeTraitCommand;
use Src\Bootstrap\Foundation\Commands\ViewClearCommand;
use Src\Bootstrap\Foundation\Console;
use Symfony\Component\Console\Application;

class ConsoleKernel  extends Console
{


    protected static array $commands;

    static function init()
    {
        # code...

        static::$commands = [
            ViewClearCommand::class,
            ClearLogsCommand::class,
            MakeCommandCommand::class,
            MakeModelCommand::class,
            MakeServiceProviderCommand::class,
            MakeModelCommand::class,
            MakeClassCommand::class,
            MakeTraitCommand::class,
            MakeInterfaceCommand::class,
            MakeServiceCommand::class,
            MakeControllerCommand::class,
            MakeAttributeCommand::class,
            MakeMiddlewareCommand::class,
            MakeRepositoryCommand::class,
        ];

        static::$application = new Application();
    }

    public static function registerAndRunAllCommands()
    {
        # code...



        collect(static::getCommands())->each(
            function ($command) {
                # code...

                if (gettype($command) === "string") {
                    # code...

                    return static::$application->add(new $command);
                }

                static::$application->add($command);
            }
        );


        static::$application->run();
    }
}
