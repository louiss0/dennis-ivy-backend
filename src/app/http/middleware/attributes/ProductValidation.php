<?php

declare(strict_types=1);

namespace Src\App\Http\Middleware\Attributes;

use Attribute;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Src\App\Http\Middleware\Classes\ValidationMiddleware;

/**
 * Middleware Must Also Be Registered To HttpKernel or Registered on specific routes
 **/

#[Attribute(Attribute::TARGET_METHOD)]
class ProductValidation extends ValidationMiddleware implements MiddlewareInterface
{


    public function __construct(private string $fields_required_or_optional = "required")
    {

        throw_unless(
            in_array($this->fields_required_or_optional, ["required", "optional"]),
            Exception::class,
            message: "required or optional must be passed in"
        );
    }

    function fieldsToValidate(): array
    {

        return [
            "name" => [$this->fields_required_or_optional,  ["lengthMax", 255]],
            "description" => [$this->fields_required_or_optional,],
            "brand" => [$this->fields_required_or_optional, ["lengthMax", 255],],
            "category" => [$this->fields_required_or_optional,],
            "rating" => [$this->fields_required_or_optional, "numeric", ["in", [.5, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5]]],
            "count_in_stock" => [$this->fields_required_or_optional, "numeric"],
            "price" => [$this->fields_required_or_optional, "numeric"],
            "num_reviews" => [$this->fields_required_or_optional, "numeric"],

        ];
    }
}
