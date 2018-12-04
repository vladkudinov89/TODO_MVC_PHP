<?php
namespace Services;

class PhotoService
{
    public static function addImage($image): string
    {
        if (isset($image)) {

            $imageType = $image['type'];

            if ($imageType == 'image/jpg' || $imageType == 'image/jpeg' || $imageType == 'image/png')
            {
                $saveto = 'upload/' . basename($image["name"]);
                move_uploaded_file($image['tmp_name'], $saveto);
                return $saveto;
            }
        }

        return 'upload/default.png';
    }

    public static function editPhoto($old_image,$image): string
    {
        if (isset($image)) {

            $imageType = $image['type'];

            if ($imageType == 'image/jpg' || $imageType == 'image/jpeg' || $imageType == 'image/png')
            {
                $saveto = 'upload/' . basename($image["name"]);
                move_uploaded_file($image['tmp_name'], $saveto);
              return $saveto;
            }
        }
        return $old_image;
    }

}