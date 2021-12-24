<?php

use DI\Bridge\Slim\Bridge;
use Src\App\Kernels\HttpKernel;


require_once __DIR__ . '/../vendor/autoload.php';

$app = HttpKernel::bootstrap(Bridge::create())->getApp();


return $app;
