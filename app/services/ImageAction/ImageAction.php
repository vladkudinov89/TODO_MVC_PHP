<?php
namespace App\Services\ImageAction;

use App\Services\ResizePhoto\ResizePhoto;

class ImageAction implements ImageActionInterface
{
    private $image;
    private $const_width;
    private $const_height;
    private $upload_path;

    public function __construct($image , $upload_path, $const_width, $const_height)
    {
        $this->image = $image;
        $this->upload_path = $upload_path;
        $this->const_width = $const_width;
        $this->const_height = $const_height;
    }

    public function imageAction()
    {
        $imageType = $this->image['type'];

        if ($imageType == 'image/jpg' || $imageType == 'image/jpeg' || $imageType == 'image/png') {

            list($width, $height) = getimagesize($this->image['tmp_name']);

            if ($width >= $this->const_width || $height >= $this->const_height) {

                $saveto = new ResizePhoto(
                    $this->image,
                    $this->upload_path,
                    $imageType,
                    $width,
                    $height,
                    $this->const_width,
                    $this->const_height
                );

                return $saveto->imageResize();

            } else {
                $saveto = $this->upload_path . basename($this->image["name"]);
                move_uploaded_file($this->image['tmp_name'], $saveto);
            }

            return $saveto;
        }
    }

}