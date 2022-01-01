<?php

declare(strict_types=1);

namespace Src\App\Http\Controllers;

use Louiss0\SlimRouteRegistry\Attributes\UseMiddleWareOn;
use Louiss0\SlimRouteRegistry\Contracts\CRUDControllerContract;
use Psr\Http\Message\ResponseInterface;

use Slim\Http\Response;

use Slim\Http\ServerRequest;
use Slim\Psr7\UploadedFile;
use Src\App\Http\Middleware\Attributes\ProductValidation;
use Src\App\Http\Middleware\Attributes\RouteRestrictionMiddleware;
use Src\App\Http\Middleware\Attributes\TokenAuthMiddleware;
use Src\App\Services\{
    ImageUploader
};

use Src\Types\Enums\CommonHTTPStatusCodes;
use Src\Types\Interfaces\IProductRepository;



#[
    UseMiddleWareOn(
        method_names: [
            self::STORE,
            self::UPDATE
        ],
        middleware: [
            RouteRestrictionMiddleware::class,
            TokenAuthMiddleware::class,
        ]
    )
]
class ProductsController implements CRUDControllerContract
{





    public function __construct(
        private IProductRepository $productRepository,
        private ImageUploader $imageUploader

    ) {
    }


    function index(ServerRequest $request, Response $response): Response
    {
        # code...



        return $response->withJson(
            data: [
                "status" => "success",
                "message" => " ",
                "data" => []
            ]
        );
    }

    public function show(
        int $id,
        Response $response,
    ): Response {
        # code...

        return $response->withJson(
            data: [
                "status" => "success",
                "message" => " ",
                "data" => []
            ]
        );
    }



    #[ProductValidation()]
    public function store(ServerRequest $request, Response $response): Response
    {
        # code...


        /** @var UploadedFile $uploadedFile   */
        ["image" => $uploadedFile] = $request->getUploadedFiles();



        $file_path = $this->imageUploader->upload($uploadedFile, "product");




        return $response->withJson(
            data: [
                "status" => "success",
                "message" => "Products is created ",
                "data" => [
                    "product" =>
                    $this->productRepository
                        ->createOne(array_merge(
                            $request->getParsedBody(),
                            ["image" => $file_path]

                        ))

                ]
            ],
            status: CommonHTTPStatusCodes::CREATED
        );
    }


    #[ProductValidation("optional")]
    public function update(int $id, ServerRequest $request, Response $response): Response
    {


        return $response->withJson(
            data: [
                "status" => "success",
                "message" => "Products is created ",
                "data" => []
            ],
        );
    }

    public function destroy(
        int $id,
        Response $response,
    ): Response {
        # code...




        return $response->withJson(
            data: [
                "status" => "success",
                "message" => "Products is deleted"
            ]
        );
    }
}
