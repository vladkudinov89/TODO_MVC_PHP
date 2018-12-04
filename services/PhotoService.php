<?php
namespace Services;

class PhotoService implements PhotoServiceInterface
{
    public const WIDTH = 320;
    public const HEIGHT = 240;

    public static function addImage($image): string
    {
        if (isset($image)) {

            $imageType = $image['type'];

            list($width, $height) = getimagesize($image['tmp_name']);
//            print_r($w);
//            print_r($h);

            if ($imageType == 'image/jpg' || $imageType == 'image/jpeg' || $imageType == 'image/png')
            {
                if($width >= self::WIDTH || $height >= self::HEIGHT )
                {
                    $saveto = 'uploads/'.$width.'x'.$height.'_'.$image['name'];
                    $image_p = imagecreatetruecolor(self::WIDTH, self::HEIGHT);
//                    print_r("Big photo");
                    imagecopyresampled(
                        $image_p,
                        $image,
                        0, 0, 0, 0,
                        self::WIDTH, self::HEIGHT,
                        $width, $height);
                } else {
                    $saveto = 'upload/' . basename($image["name"]);
                    move_uploaded_file($image['tmp_name'], $saveto);
                }

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