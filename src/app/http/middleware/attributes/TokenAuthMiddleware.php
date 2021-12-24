<?php

namespace Src\App\Http\Middleware\Attributes;

use Attribute;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Src\App\Services\TokenAuthService;

/**
 * Middleware Must Also Be Registered To HttpKernel or Registered on specific routes
 **/

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class TokenAuthMiddleware implements MiddlewareInterface
{



    private const ZERO = 0;

    private const ONE = 1;

    private TokenAuthService $tokenAuthService;

    public function __construct()
    {

        $this->tokenAuthService = new TokenAuthService;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = null;


        $auth_header = $request->getHeader("Authorization");


        $this->checkIfAuthorizationHeaderIsSet($request);

        $bearer_array =  explode(" ", $auth_header[self::ZERO]);


        $this->checkIfAuthorizationHeaderStartsWithBearer($request, $bearer_array[self::ZERO]);


        $token = $bearer_array[self::ONE];


        $this->checkIfThereIsNoToken($request, $token);

        $this->tokenAuthService->checkIfTokenIsExpired($request, $token);

        $this->tokenAuthService->verifyToken($request, $token);


        return $handler->handle(
            $request->withAttribute(
                "token",
                $token
            )
        );
    }



    private function checkIfAuthorizationHeaderIsSet(ServerRequestInterface $request): void
    {
        # code...

        $no_auth_header = !$request->hasHeader("Authorization");

        throw_if(
            $no_auth_header,
            HttpUnauthorizedException::class,
            $request,
            'A Bearer Token must be sent Please log in to get access.',
        );
    }

    private function checkIfAuthorizationHeaderStartsWithBearer(ServerRequestInterface
    $request,  string $bearer_array): void
    {

        $auth_header_does_not_start_with_bearer = !str_starts_with(
            haystack: $bearer_array,
            needle: "Bearer"
        );

        throw_if(
            $auth_header_does_not_start_with_bearer,
            HttpUnauthorizedException::class,
            $request,
            'You are not logged in! Please log in to get access.',
        );
    }



    private function checkIfThereIsNoToken(ServerRequestInterface $request, string |null $token): void
    {
        # code...

        $no_token = !$token;

        throw_if(
            $no_token,
            HttpUnauthorizedException::class,
            $request,
            'You are not logged in! Please log in to get access.',
        );
    }
}
