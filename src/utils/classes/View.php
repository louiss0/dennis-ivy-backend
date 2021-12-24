<?php

namespace Src\Utils\Classes;

use Jenssegers\Blade\Blade;
use Slim\Psr7\Factory\ResponseFactory;

class View
{

    private Blade $blade;
    public function __construct(
        private ResponseFactory $responseFactory
    ) {


        $cache = storage_path("cache");

        $views =  resources_path("views");


        $this->blade = new Blade($views, $cache);
    }


    public function __invoke(string $template, $data = [])
    {
        # code...

        $response = $this->responseFactory->createResponse();

        $response->getBody()
            ->write(
                $this->blade
                    ->make($template, $data)
                    ->render()
            );

        return $response;
    }

    public function render(string $template, $data = [])
    {
        # code...
        return $this->blade
            ->make($template, $data)
            ->render();
    }
}
