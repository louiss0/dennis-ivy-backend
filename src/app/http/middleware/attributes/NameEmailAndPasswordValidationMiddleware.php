<?php

namespace Src\App\Http\Middleware\Attributes;

use Attribute;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface as Handle;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Src\App\Http\Middleware\Classes\ValidationMiddleware;

/**
 * Middleware Must Also Be Registered To HttpKernel or Registered on specific routes
 **/
#[Attribute(Attribute::TARGET_METHOD)]
class NameEmailAndPasswordValidationMiddleware extends ValidationMiddleware implements MiddlewareInterface

{

    public function fieldsToValidate(): array
    {


        $fields = [
            "name" => [
                "required",
                ["different", "password", "email"],
            ],
            "password" => [
                "required",
                ["lengthMin", 8],
                ["different", "email"]
            ],
            "email" => [
                "email",
                ["requiredWith", "password", "name",],
            ],
        ];

        return $fields;
    }
}
