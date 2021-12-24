<?php



namespace Src\Types\Enums;


interface ImageRecognitionEnum
{
    public const JPG = "jpg";
    public const JPEG = "jpeg";
    public const PNG = "png";
    public const GIF = "gif";
    public const TIFF = "tiff";
    public const MIME_TYPE_JPG = "image/jpg";
    public const IMAGE_FILE_TYPE_PATTERN = "/^\S+(\.)(jpg|png|gif|jpeg|tiff)$/";
    public const IMAGE_MIME_TYPE_PATTERN = "/^image(\/)(jpg|png|gif|jpeg|tiff)$/";
    public const MIME_TYPE_JPEG = "image/jpeg";
    public const MIME_TYPE_PNG = "image/png";
    public const MIME_TYPE_GIF = "image/gif";
    public const MIME_TYPE_TIFF = "image/tiff";
}
