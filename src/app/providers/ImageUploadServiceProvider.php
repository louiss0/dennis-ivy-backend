<?php

namespace Src\App\Providers;

use Src\App\Services\ImageUpload;

/**
 * Register Service Provider To Application within config/app.php
 */
class ImageUploadServiceProvider extends ServiceProvider
{
    /**
     * Register ServiceProvider Hooks Run First
     */
    public function register()
    {


        $this->bindToContainer(ImageUpload::class, fn () => new ImageUpload);
    }

    /**
     * After all register ServiceProviders Hooks complete, then
     * all boot ServiceProvider Hooks are executed
     */
    public function boot()
    {
        //
    }
}
