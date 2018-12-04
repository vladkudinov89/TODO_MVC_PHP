<?php

namespace Services;


interface PhotoServiceInterface
{
    public static function addImage($image): string;

    public static function editPhoto($old_image,$image): string;
}