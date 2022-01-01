<?php

namespace Src\App\Services;

use Intervention\Image\ImageManager;
use Slim\Psr7\UploadedFile;

class ImageUploader

{




    private ImageManager $imageUploader;

    private string $storage_path;

    public function __construct()
    {
        $this->imageUploader = new ImageManager();

        $this->storage_path = storage_path("images");
    }




    public function upload(UploadedFile $uploadedFile, string $image_prefix = "image"): string
    {
        # code...

        $image = $this->imageUploader->make($uploadedFile->getFilePath());



        $filename =  uniqid($image_prefix) . ".jpg";

        $image
            ->resize(300, 300)
            ->save(
                "{$this->storage_path}/{$filename}",
                100,
                "jpg"
            );

        $storage_slash_image_absolute_directory_path = preg_replace("/\S+(?=\/storage)/", "", $this->storage_path);

        return "{$storage_slash_image_absolute_directory_path}/{$filename}";
    }
}
