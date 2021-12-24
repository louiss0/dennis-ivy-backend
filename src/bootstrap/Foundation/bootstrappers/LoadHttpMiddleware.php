<?php


namespace Src\Bootstrap\Foundation\Bootstrappers;

use Src\App\Kernels\Kernel;

class LoadHttpMiddleware extends Bootstrapper
{


    public function boot()
    {
        # code...

        $kernel = $this->getContainer()->get(Kernel::class);

        $this->getContainer()->set("middleware", fn () => [
            'global' => $kernel->getMiddleware(),
            'api' => $kernel->getAPIMiddleware(),
            'web' => $kernel->getWebMiddleware(),
        ]);
    }
}
