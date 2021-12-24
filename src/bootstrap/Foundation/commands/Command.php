<?php


namespace Src\Bootstrap\Foundation\Commands;

use Src\Bootstrap\Foundation\Console;
use Symfony\Component\Console\Input\InputArgument;

class Command extends Console
{

    protected $name = "command:add-signature";
    protected $help = "Add help info";
    protected $description = "Add description information";


    protected function require($description = "")
    {
        # code...

        return [InputArgument::REQUIRED, $description];
    }


    protected function array($description = "", $default = [])
    {
        # code...

        return [InputArgument::IS_ARRAY, $description, $default];
    }
    protected function optional($description = "", $default = false)
    {
        # code...

        return $default
            ? [InputArgument::OPTIONAL, $description, $default]
            : [InputArgument::OPTIONAL, $description,];
    }


    protected function arguments()
    {
        # code...

        return [];
    }


    public function configure()
    {
        # code...

        $this->setName($this->name)
            ->setHelp($this->help)
            ->setDescription($this->description);

        collect($this->arguments())->each(
            fn ($options, $name) =>
            $this->addArgument($name, ...$options)
        );

        if (method_exists($this, 'afterConfiguration')) {

            $this->afterConfiguration();
        }
    }

    public function handler()
    {
        // Handle command

    }
}
