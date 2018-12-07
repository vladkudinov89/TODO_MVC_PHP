<?php
namespace App\Services;

use App\Services\ImageAction\ImageAction;

class PhotoService implements PhotoServiceInterface
{
    public const WIDTH = 320;
    public const HEIGHT = 240;
    public const UPLOAD_PATH = 'upload/';

    public function addImage($image): string
    {
        if (isset($image)) {

            $saveto = new ImageAction(
                $image,
                self::UPLOAD_PATH,
                self::WIDTH,
                self::HEIGHT
            );

            return $saveto->imageAction();
        }

        return self::UPLOAD_PATH . 'default.png';
    }


    public function editPhoto($old_image, $image): string
    {
        if (isset($image)) {

            $saveto = new ImageAction(
                $image,
                self::UPLOAD_PATH,
                self::WIDTH,
                self::HEIGHT
            );

            return $saveto->imageAction();
        }
        return $old_image;
    }

}