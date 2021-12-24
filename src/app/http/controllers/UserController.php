<?php

namespace Src\App\Http\Controllers;

use Louiss0\SlimRouteRegistry\Attributes\UseMiddleWareOn;
use Louiss0\SlimRouteRegistry\Contracts\CRUDControllerContract;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Src\Types\Enums\CommonHTTPStatusCodes;
use Src\App\Http\Middleware\Attributes\TokenAuthMiddleware;
use Src\App\Http\Middleware\Attributes\RouteRestrictionMiddleware;
use Src\App\Repositories\UserRepository;


#[
    UseMiddleWareOn(
        [
            UserController::SHOW,
            UserController::DESTROY,
            UserController::UPDATE,
        ],
        [
            RouteRestrictionMiddleware::class,
            TokenAuthMiddleware::class,
        ]
    ),
]
final class UserController implements CRUDControllerContract
{




    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function index(ServerRequest $request, Response $response): Response
    {
        # code...



        return $response->withJson(
            data: [
                "status" => "success",
                "message" => "Here are the users",
                "data" => [
                    "users" => $this->userRepository->getAllBasedOnQueryParameters(
                        $request->getQueryParams()
                    ),

                ]
            ]
        );
    }

    public function show(int $id, Response $response,): Response

    {
        # code...

        return $response->withJson(
            data: [
                "status" => "success",
                "message" => "Here is the user",
                "data" => [
                    "user" => $this->userRepository->getOne($id)

                ],
            ]
        );
    }


    public function update(int $id, Response $response): Response
    {

        return $response->withJson(
            data: [
                "status" => "success",
                "message" => "Here is the user",
                "data" => [
                    "user" => $this->userRepository->getOne($id)

                ],
            ]
        );
    }



    public function store(ServerRequest $request, Response $response): Response
    {

        # code...


        return $response->withJson(
            data: [
                "status" => "success",
                "message" => "Here is the user",
                "user" => $this->userRepository->createOne($request->getParsedBody())
            ],
            status: CommonHTTPStatusCodes::CREATED
        );
    }



    public function destroy(int $id, Response $response,): Response
    {
        # code...

        $this->userRepository->deleteOne($id);



        return $response->withJson(
            data: [
                "status" => "success",
                "message" => "User is deleted"
            ]
        );
    }
}
