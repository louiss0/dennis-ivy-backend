<?php



namespace Src\Types\Enums;

interface ImageRecognitionEnum
{
    public static const JPG = "jpg";
    public static const JPEG = "jpeg";
    public static const PNG = "png";
    public static const GIF = "gif";
    public static const TIFF = "tiff";
    public static const MIME_TYPE_JPG = "image/jpg";
    public static const IMAGE_FILE_TYPE_PATTERN = "/^\S+(\.)(jpg|png|gif|jpeg|tiff)$/";
    public static const IMAGE_MIME_TYPE_PATTERN = "/^image(\/)(jpg|png|gif|jpeg|tiff)$/";
    public static const MIME_TYPE_JPEG = "image/jpeg";
    public static const MIME_TYPE_PNG = "image/png";
    public static const MIME_TYPE_GIF = "image/gif";
    public static const MIME_TYPE_TIFF = "image/tiff";
}
