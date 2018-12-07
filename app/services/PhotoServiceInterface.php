<?php

namespace App\Services;


interface PhotoServiceInterface
{
    public function addImage($image): string;

    public function editPhoto($old_image,$image): string;
}