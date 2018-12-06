<?php

namespace Services;

use Services\ResizePhoto\ResizePhoto;

class PhotoService implements PhotoServiceInterface
{
    public const WIDTH = 320;
    public const HEIGHT = 240;
    public const UPLOAD_PATH = 'upload/';

    public function addImage($image): string
    {
        if (isset($image)) {

            $imageType = $image['type'];

            if ($imageType == 'image/jpg' || $imageType == 'image/jpeg' || $imageType == 'image/png') {

                list($width, $height) = getimagesize($image['tmp_name']);

                if ($width >= self::WIDTH || $height >= self::HEIGHT) {

                    $saveto = new ResizePhoto(
                        $image,
                        self::UPLOAD_PATH,
                        $imageType,
                        $width,
                        $height,
                        self::WIDTH,
                        self::HEIGHT
                    );

                    return $saveto->imageResize();

                } else {
                    $saveto = self::UPLOAD_PATH . basename($image["name"]);
                    move_uploaded_file($image['tmp_name'], $saveto);
                }

                return $saveto;
            }
        }

        return self::UPLOAD_PATH . 'default.png';
    }


    public function editPhoto($old_image, $image): string
    {
        if (isset($image)) {

            $imageType = $image['type'];

            if ($imageType == 'image/jpg' || $imageType == 'image/jpeg' || $imageType == 'image/png') {

                list($width, $height) = getimagesize($image['tmp_name']);

                if ($width >= self::WIDTH || $height >= self::HEIGHT) {

                    $saveto = new ResizePhoto(
                        $image,
                        self::UPLOAD_PATH,
                        $imageType,
                        $width,
                        $height,
                        self::WIDTH,
                        self::HEIGHT
                    );

                    return $saveto->imageResize();

                } else {
                    $saveto = self::UPLOAD_PATH . basename($image["name"]);
                    move_uploaded_file($image['tmp_name'], $saveto);
                }

                return $saveto;
            }
        }
        return $old_image;
    }

}