<?php

namespace Src\App\Http\Middleware\Attributes;

use Attribute;
use Psr\Http\Server\MiddlewareInterface;
use Src\App\Http\Middleware\Classes\ValidationMiddleware;

/**
 * Middleware Must Also Be Registered To HttpKernel or Registered on specific routes
 **/
#[Attribute(Attribute::TARGET_METHOD)]
class EmailAndPasswordValidationMiddleware extends ValidationMiddleware implements MiddlewareInterface
{



    public function fieldsToValidate(): array
    {

        $fields = [
            "password" => [
                "required",
                ["lengthMin", 8],
            ],
            "email" => [
                "email",
                "required",
                ["requiredWith", "password"],
            ],
        ];

        return $fields;
    }
}
