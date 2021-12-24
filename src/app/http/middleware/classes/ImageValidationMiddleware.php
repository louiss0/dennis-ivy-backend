<?php

namespace Src\App\Http\Middleware\Classes;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface as Handle;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Psr7\UploadedFile;
use Src\Types\Enums\ImageRecognitionEnum;

/**
 * Middleware Must Also Be Registered To HttpKernel or Registered on specific routes
 **/
class ImageValidationMiddleware implements MiddlewareInterface
{

    public function process(Request $request, Handle $handler): ResponseInterface
    {

        $files = $request->getUploadedFiles();

        $callback = function (UploadedFile $file) use ($request) {

            $this->checkIfImageHasAcceptableFileSize($request, $file);

            $this->checkIfImageHasProperFileMineAndFileType($request, $file);
        };


        array_walk(
            callback: $callback,
            array: $files,
        );


        return $handler->handle($request);
    }


    private function checkIfImageHasProperFileMineAndFileType(ServerRequestInterface $request, UploadedFile $uploadedFile)
    {
        # code...

        [$media_type, $filename] = [
            $uploadedFile->getClientMediaType(),
            $uploadedFile->getClientFilename(),
        ];




        $match_file_name = !!preg_match(
            pattern: ImageRecognitionEnum::IMAGE_FILE_TYPE_PATTERN,
            subject: $filename
        );

        $match_mime_type = !!preg_match(
            pattern: ImageRecognitionEnum::IMAGE_MIME_TYPE_PATTERN,
            subject: $media_type
        );

        $image_has_no_proper_mime_type_or_file_type = !($match_file_name && $match_mime_type);



        throw_unless(
            $image_has_no_proper_mime_type_or_file_type,
            HttpInternalServerErrorException::class,
            $request,
            <<<HDOC
            File must have a type jpg png tiff jpeg gif. 
            Or mimetype of image/jpg image/png image/tiff image/jpeg gif.
            HDOC,
        );
    }


    private function checkIfImageHasAcceptableFileSize(ServerRequestInterface $request, UploadedFile $uploadedFile)
    {
        # code...
        $acceptable_file_size = 5 * pow(1024, 2);


        $file_size = $uploadedFile->getSize();

        $file_size_is_greater_than_acceptable_file_size =
            $file_size > $acceptable_file_size;

        throw_unless(
            $file_size_is_greater_than_acceptable_file_size,
            HttpInternalServerErrorException::class,
            $request,
            "File size muse be lower than or equal to {$acceptable_file_size}"
        );
    }
}
