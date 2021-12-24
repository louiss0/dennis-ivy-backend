<?php

namespace Src\Bootstrap\Foundation\Bootstrappers;

use Zeuxisoo\Whoops\Slim\WhoopsMiddleware;
use Slim\Factory\ServerRequestCreatorFactory;
use Slim\Http\Factory\DecoratedResponseFactory;
use Slim\Psr7\Factory\StreamFactory;
use Src\App\Exceptions\Handlers\HttpErrorHandler;
use Src\App\Exceptions\Handlers\ShutdownHandler;

class LoadDebuggingPage extends Bootstrapper
{


    private bool $displayErrorDetails = true;
    private bool $logErrors = true;
    private bool $logErrorDetails = true;


    public function boot()
    {
        # code...



        $callableResolver = $this->app->getCallableResolver();
        $responseFactory = $this->app->getResponseFactory();

        $decoratedResponseFactory = new DecoratedResponseFactory(
            $responseFactory,
            new StreamFactory
        );




        $serverRequestCreator = ServerRequestCreatorFactory::create();
        $request = $serverRequestCreator->createServerRequestFromGlobals();


        $errorHandler = new HttpErrorHandler($callableResolver, $decoratedResponseFactory);

        if (env("PHP_ENV") === "development") {

            return $this->app->add(new WhoopsMiddleware());
        }


        $shutdownHandler = new ShutdownHandler(
            $request,
            $errorHandler,
            $this->displayErrorDetails
        );


        register_shutdown_function($shutdownHandler);



        $this->app->addErrorMiddleware(
            $this->displayErrorDetails,
            $this->logErrors,
            $this->logErrorDetails,
        );
    }
}
