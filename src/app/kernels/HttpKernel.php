<?php

namespace Src\App\Kernels;

class HttpKernel extends Kernel
{


    protected $middleware = [];

    protected $middlewareGroups = [
        "api" => [],
        "web" => [],
    ];




    /**
     * Get the value of middleware
     */
    public function getMiddleware()
    {

        return $this->middleware;
    }

    /**
     * Get the value of middleware
     */
    public function getAPIMiddleware()
    {
        return $this->middlewareGroups["api"];
    }

    /**
     * Get the value of middleware
     */
    public function getWebMiddleware()
    {
        return $this->middlewareGroups["web"];
    }
}
