<?php
namespace Services\ResizePhoto;

class ResizePhoto implements ResizePhotoInterface
{
    private $image;
    private $upload_path;
    private $imageType;
    private $src_width;
    private $src_height;
    private $const_width;
    private $const_height;

    public function __construct(
        $image,
        $upload_path,
        $imageType,
        $src_width,
        $src_height,
        $const_width,
        $const_height
    )
    {
        $this->image = $image;
        $this->upload_path = $upload_path;
        $this->imageType = $imageType;
        $this->src_width = $src_width;
        $this->src_height = $src_height;
        $this->const_width = $const_width;
        $this->const_height = $const_height;
    }

    public function imageResize()
    {
        $saveto = $this->upload_path . $this->const_width . 'x' . $this->const_height . '_' . $this->image['name'];

        switch ($this->imageType) {
            case 'image/png':
                $imageSrc = imagecreatefrompng($this->image['tmp_name']);
                $tmp = $this->imageResizeAction($imageSrc, $this->src_width, $this->src_height);
                imagepng($tmp, $saveto);
                break;

            case 'image/jpg' || 'image/jpeg':
                $imageSrc = imagecreatefromjpeg($this->image['tmp_name']);
                $tmp = $this->imageResizeAction($imageSrc, $this->src_width, $this->src_height);
                imagejpeg($tmp, $saveto);
                break;

            default:
                echo "Invalid Image type.";
                exit;
                break;
        }
        return $saveto;
    }

    public function imageResizeAction($imageSrc, $imageWidth, $imageHeight)
    {
        $newImageLayer = imagecreatetruecolor($this->const_width, $this->const_height);
        imagecopyresampled(
            $newImageLayer,
            $imageSrc, 0, 0, 0, 0,
            $this->const_width, $this->const_height,
            $imageWidth, $imageHeight);

        return $newImageLayer;
    }

}