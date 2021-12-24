<?php

namespace Src\App\Http\Middleware\Classes;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpUnauthorizedException;
use Valitron\Validator;

abstract class ValidationMiddleware  implements MiddlewareInterface
{




    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface

    {
        $v = new Validator($request->getParsedBody());

        $v->mapFieldsRules($this->fieldsToValidate());




        throw_unless(
            condition: $v->validate(),
            exception: HttpUnauthorizedException::class,
            request: $request,
            message: json_encode($v->errors())
        );


        return $handler->handle($request);
    }


    abstract public function fieldsToValidate(): array;
}
