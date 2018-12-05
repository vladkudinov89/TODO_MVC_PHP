<?php

namespace Services\ResizePhoto;

interface ResizePhotoInterface
{
    public function imageResize();

    public function imageResizeAction($imageSrc, $imageWidth, $imageHeight);
}