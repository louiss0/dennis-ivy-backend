<?php


require __DIR__ . '/../vendor/autoload.php';

use Src\App\Kernels\ConsoleKernel;


// ! make commands with required arguments here

ConsoleKernel::init();


ConsoleKernel::addCommand("make:example {name}", function () {


    assert($this instanceof ConsoleKernel);


    $this->setHelp("make a command with required arguments here")
        ->setDescription("This is a command with only one purpose show off");
});
