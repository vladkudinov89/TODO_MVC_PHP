<?php

namespace Services;


interface PhotoServiceInterface
{
    public function addImage($image): string;

    public static function editPhoto($old_image,$image): string;
}