<?php

namespace Services;

class PhotoService implements PhotoServiceInterface
{
    public const WIDTH = 320;
    public const HEIGHT = 240;
    public const UPLOAD_PATH = 'upload/';

    public static function addImage($image): string
    {
        if (isset($image)) {

            $imageType = $image['type'];

            list($width, $height) = getimagesize($image['tmp_name']);

            if ($imageType == 'image/jpg' || $imageType == 'image/jpeg' || $imageType == 'image/png') {

                if ($width >= self::WIDTH || $height >= self::HEIGHT) {

                    $saveto = self::UPLOAD_PATH . self::WIDTH . 'x' . self::HEIGHT . '_' . $image['name'];

                    switch ($imageType) {
                        case 'image/png':
                            $imageSrc = imagecreatefrompng($image['tmp_name']);
                            $tmp = self::imageResize($imageSrc, $width, $height);
                            imagepng($tmp, $saveto);
                            break;

                        case 'image/jpg' || 'image/jpeg':
                            $imageSrc = imagecreatefromjpeg($image['tmp_name']);
                            $tmp = self::imageResize($imageSrc, $width, $height);
                            imagejpeg($tmp, $saveto);
                            break;

                        default:
                            echo "Invalid Image type.";
                            exit;
                            break;
                    }

                } else {
                    $saveto = self::UPLOAD_PATH . basename($image["name"]);
                    move_uploaded_file($image['tmp_name'], $saveto);
                }

                return $saveto;
            }
        }

        return self::UPLOAD_PATH.'default.png';
    }

    private static function imageResize($imageSrc, $imageWidth, $imageHeight)
    {
        $newImageLayer = imagecreatetruecolor(self::WIDTH, self::HEIGHT);
        imagecopyresampled($newImageLayer, $imageSrc, 0, 0, 0, 0, self::WIDTH, self::HEIGHT, $imageWidth, $imageHeight);

        return $newImageLayer;
    }

    public static function editPhoto($old_image, $image): string
    {
        if (isset($image)) {

            $imageType = $image['type'];

            if ($imageType == 'image/jpg' || $imageType == 'image/jpeg' || $imageType == 'image/png') {
                $saveto = self::UPLOAD_PATH . basename($image["name"]);
                move_uploaded_file($image['tmp_name'], $saveto);
                return $saveto;
            }
        }
        return $old_image;
    }

}