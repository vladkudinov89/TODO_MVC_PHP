<?php
namespace Services;

class PhotoService
{
    public static function addImage($image)
    {
        print_r($image);
        if (isset($image)) {

//            $image = $_FILES['taskphoto'];

            $imageType = $image['type'];

            if ($imageType == 'image/jpg' || $imageType == 'image/jpeg' || $imageType == 'image/png')
            {
                $saveto = 'upload/' . basename($image["name"]);
                move_uploaded_file($image['tmp_name'], $saveto);
                return $saveto;
            }
        } else {
            return 'upload/default.png';
        }

    }

    public static function editPhoto($image)
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
    }

}