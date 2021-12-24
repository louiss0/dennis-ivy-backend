<?php

namespace Src\App\Http\Middleware\Attributes;

use Attribute;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface as Handle;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Src\App\Services\TokenAuthService;

/**
 * Middleware Must Also Be Registered To HttpKernel or Registered on specific routes
 **/
#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class RouteRestrictionMiddleware implements MiddlewareInterface
{



    private TokenAuthService $tokenAuthService;

    public function __construct(
        private $role_restrictions = ["admin"]
    ) {

        $this->tokenAuthService = new TokenAuthService;
    }

    function process(Request $request, Handle $handler): ResponseInterface
    {

        $token = $request->getAttribute("token");


        $this->checkIfUserHasTheRightRole(
            $request,
            $this->tokenAuthService->getRoleFromToken($token)
        );

        $response = $handler->handle(
            $request
                ->withAttribute(
                    "claims",
                    $this->tokenAuthService->getClaimsFromToken($token)
                )
        );


        return $response;
    }



    private function checkIfUserHasTheRightRole(
        Request $request,
        string  $role
    ) {


        $role_is_not_one_of_the_role_restrictions =
            !in_array(
                needle: $role,
                haystack: $this->role_restrictions,
                strict: true
            );

        $roles = implode(" ",  $this->role_restrictions);

        $message = "You are not allowed here you must be one of these {$roles}";

        throw_if(
            $role_is_not_one_of_the_role_restrictions,
            HttpUnauthorizedException::class,
            $request,
            $message
        );
    }
}
