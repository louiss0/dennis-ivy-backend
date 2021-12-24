<?php

namespace Src\Utils\Traits;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

trait FormatOutput
{


    abstract function getInput(): InputInterface;
    abstract function getOutput(): OutputInterface;

    protected function info($content)
    {
        // green text
        $this->getOutput()->writeln("<info>{$content}</info>");

        return $this;
    }

    protected function comment($content)
    {
        // yellow text
        $this->getOutput()->writeln("<comment>{$content}</comment>");

        return $this;
    }

    protected function question($content)
    {
        // black text on a cyan background
        $this->getOutput()->writeln("<question>{$content}</question>");

        return $this;
    }

    protected function error($content)
    {
        // white text on a red background
        $this->getOutput()->writeln("<error>{$content}</error>");

        return $this;
    }
}
