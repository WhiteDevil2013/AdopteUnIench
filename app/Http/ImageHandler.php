<?php

namespace AdopteUnIench\Http;
use Illuminate\Support\Facades\Storage;

/**
 * Created by IntelliJ IDEA.
 * User: Lorris
 * Date: 01/07/2017
 * Time: 16:58
 */
class ImageHandler
{
    private function resizeImage($fileToResize)
    {
        list($orig_width, $orig_height) = getimagesize($fileToResize);

        $width = $orig_width;
        $height = $orig_height;

        $dst_image = imagecreatetruecolor(420, 420);
        $type = mime_content_type($fileToResize);
        $src_image = null;
        switch (substr($type, 6)) {
            case 'jpeg':
                $src_image = imagecreatefromjpeg($fileToResize);
                break;
            case 'gif':
                $src_image = imagecreatefromgif($fileToResize);
                break;
            case 'png':
                $src_image = imagecreatefrompng($fileToResize);
                break;
            case 'bmp':
                $src_image = imagecreatefromwbmp($fileToResize);
                break;
        }
        imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, 420, 420, $width, $height);

        imagejpeg($dst_image, $fileToResize, 100);
    }

    public function uploadImageOnDisk($fileToUpload)
    {
        $this->resizeImage($fileToUpload['tmp_name']);
        $imageData = addslashes($fileToUpload['tmp_name']);
        $imageData = file_get_contents($imageData);
        $imageName = addslashes($fileToUpload['name']);
        Storage::disk('images')->put($imageName, $imageData);
        return $imageName;
    }

    public function updateImageOnDisk($fileToUpload, $previousImgName)
    {
        $this->resizeImage($fileToUpload['tmp_name']);
        $imageData = addslashes($fileToUpload['tmp_name']);
        $imageData = file_get_contents($imageData);
        $imageName = addslashes($fileToUpload['name']);
        Storage::disk('images')->delete($previousImgName);
        Storage::disk('images')->put($imageName, $imageData);
        return $imageName;
    }

    public function isImage($imgPath)
    {
        $tmpName = $imgPath['tmp_name'];
        switch (substr(mime_content_type($tmpName), 6))
        {
            case 'jpeg' || 'png' || 'gif' || 'bmp':
                return true;
        }
        return false;
    }
}