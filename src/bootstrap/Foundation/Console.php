<?php



namespace Src\Bootstrap\Foundation;

use Closure;
use Exception;
use Illuminate\Support\Str;
use Src\Utils\Traits\FormatOutput;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Console extends Command

{


    use FormatOutput;

    protected static Application $application;

    protected static array  $commands;

    private InputInterface $input;
    private OutputInterface $output;

    private ?Closure $handler =  null;
    /**
     * Get the value of commands
     */
    public static function getCommands()
    {
        return collect(static::$commands);
    }




    public static function addCommand(
        string $signature,
        Closure $closure
    ) {
        # code...

        $command = new static;


        $command->setHandler($closure);


        $input = explode(" ", $signature);




        $command->setName($input[0]);


        array_shift($input);




        $set_name = fn (string $arg) =>
        Str::of($arg)->between("{", "}");

        $add_argument = fn (string $arg) =>

        $command->addArgument(
            $set_name($arg),
            InputArgument::REQUIRED
        );


        collect($input)->each($add_argument);

        collect(static::$commands)->add($command);

        return $command;
    }

    /**
     * Set the value of handler
     *
     * @return  self
     */
    public function setHandler(Closure $handler)
    {
        $this->handler = $handler->bindTo($this, $this);

        return $this;
    }

    public function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        # code...

        $this->input = $input;
        $this->output = $output;

        $the_handler_is_not_callable_or_method_does_not_exist =
            !is_callable($this->handler) && !method_exists($this, "handler");


        throw_if(
            $the_handler_is_not_callable_or_method_does_not_exist,
            Exception::class,
            "No handler defined"
        );




        $this->handler();


        return Command::SUCCESS;
    }

    public function __call(string $method, $parameters)
    {
        # code...


        throw_if(
            $method !== "handler",
            "Method {$method}, doesn't exist"
        );


        call_user_func($this->handler, $parameters);
    }




    /**
     * Get the value of input
     */
    public function getInput(): InputInterface
    {
        return $this->input;
    }

    /**
     * Get the value of output
     */
    public function getOutput(): OutputInterface
    {
        return $this->output;
    }
}
