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
class PasswordAndPasswordConfirmValidationMiddleware extends ValidationMiddleware implements MiddlewareInterface
{

    public function fieldsToValidate(): array
    {
        # code...

        $fields = [
            "password" => [
                "required",
                [
                    "lengthMin", 8
                ],
                ["requiredWith", "password-confirm"],
                ["equals", "password-confirm"]
            ],

            "password-confirm" => [
                "required",
                [
                    "lengthMin", 8
                ]
            ],
        ];

        return $fields;
    }
}
