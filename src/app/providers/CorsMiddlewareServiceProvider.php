<?php


namespace Src\App\Providers;

use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Src\Types\Enums\MonoLoggers;
use Tuupola\Middleware\CorsMiddleware;

class CorsMiddlewareServiceProvider extends ServiceProvider

{

    public function register()
    {
        # code...

        $logger = ($this->resolve(MonoLoggers::REQUEST_LOGGER))
            ->withName(MonoLoggers::CORS_LOGGER);




        $logger->debug("#{CorsMiddleware::class} activated");

        $logger->toMonologLevel(Logger::INFO);


        $settings = [
            "origin" => ["*"],
            "headers.allow" => [
                'X-Requested-With',
                "Content-Type",
                "Accept",
                "Origin",
                "If-Match",
                "If-Unmodified-Since",
                "Authorization"
            ],
            "methods" => [
                "GET",
                "POST",
                "PUT",
                "PATCH",
                "DELETE",
                "OPTIONS"
            ],
            "headers.expose" => ["Etag"],
            "credentials" => true,
            "cache" => 86400,
            "logger" => $logger
        ];

        $this->bindToContainer(
            CorsMiddleware::class,
            fn () => new CorsMiddleware($settings)
        );
    }

    public function boot()
    {
        # code...

        ["global" => $global, "web" => $web, "api" => $api] = $this->resolve("middleware");

        $this->bindToContainer(
            "middleware",
            fn () => [
                "global" => [
                    $this->resolve(CorsMiddleware::class),
                    ...$global
                ],
                "web" => $web,
                "api" => $api
            ]
        );
    }
}
