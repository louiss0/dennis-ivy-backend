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
class PasswordCurrentPasswordAndPasswordConfirmValidationMiddleware extends ValidationMiddleware implements MiddlewareInterface
{


    public function fieldsToValidate(): array
    {
        $fields = [
            "password" => [
                ["requiredWith", "password-confirm", "password-current",],
                ["lengthMin", 8],
            ],
            "password-confirm" => [
                "required",
                ["lengthMin", 8],
                ["equals", "password"]
            ],
            "password-current" => [
                "required",
                ["different", "password", "password-confirm",],
            ]
        ];

        return $fields;
    }
}
