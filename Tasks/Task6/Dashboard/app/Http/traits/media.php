<?php

namespace App\Http\traits;

trait media
{
    public function uploadImage($image, $dir)
    {
        $photoName = time() . '.' . $image->extension();
        $image->move(public_path("images\\" . $dir), $photoName);
        return $photoName;
    }

    public function deleteImage($image, $dir)
    {
        $photoPath = public_path("images\\$dir\\$image");
        if ($image != 'default.png') {
            if (file_exists($photoPath)) {
                unlink($photoPath);
                return true;
            }
        }
        return false;
    }
}
