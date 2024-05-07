<?php

namespace App\Helpers;

use Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageUploadHelper
{
    public function uploadImage($storageName, $imageFile, $imageName, $checkImage = null)
    {
        if($checkImage != null) {
            $checkImage = $this->reformateCheckImage($checkImage);
            if (Storage::disk($storageName)->exists($checkImage)) {
                Storage::disk($storageName)->delete($checkImage);
            }
        }

        $getImageName = str_replace(' ','-',$imageName).time().'.'.$imageFile->getClientOriginalExtension();
        $uploadedFile = Storage::disk($storageName)->put($getImageName, file_get_contents($imageFile));

        return $getImageName;
    }

    public function deleteImage($storageName, $checkImage)
    {
        if($checkImage != null) {
            $checkImage = $this->reformateCheckImage($checkImage);
            if (Storage::disk($storageName)->exists($checkImage)) {
                Storage::disk($storageName)->delete($checkImage);
            }
        }

        return ['message_success', 'Image - '.$checkImage.' has been deleted from Storage - '.$storageName];
    }

    public function uploadImageResizing($encodeType = null, $image, $storageName, $checkImage = null, $maxSize = null, $width = null, $height = null, $imageName = null, $thumbnail = ['width' => null, 'height' => null, 'thumbStorageName' => null])
    {
        if ($image) {
            // check image size
            if(!$encodeType)
            {
                $imageSize = $image->getSize();
                // 1 mb = 1048576 bytes in binary which is countable for the image size here
                if($maxSize !== 0 && $maxSize !== null){
                    if ($imageSize > $maxSize) {
                        return 'MaxSizeErr';
                    }
                }
            }
            // check existing image
            if($checkImage != null) {
                $checkImage = $this->reformateCheckImage($checkImage);
                if (Storage::disk($storageName)->exists($checkImage)) {
                    Storage::disk($storageName)->delete($checkImage);
                }
            }
            // rename image
            // $imageName =date('Y_m_d_h_i_s') . '.' . $image->getClientOriginalExtension();
            if($imageName == null) {
                $imageName = $encodeType ? date('Y_m_d_h_i_s') . '.' .$encodeType : date('Y_m_d_h_i_s') . '.' . $image->clientExtension();
            }else{
                $imageName = $encodeType ? Str::slug($imageName, '_') . date('Y_m_d_h_i_s') . '.' .$encodeType : Str::slug($imageName, '_') . date('Y_m_d_h_i_s') . '.' . $image->clientExtension();
            }

            // get the image
            $imageFile = $encodeType ? Image::make($image)->encode($encodeType) : Image::make($image);
            // resize image when width & height are null
            if($width === null && $height === null) {
                $imageFile->stream();
            }
            // resize image when width & height are not null
            if($width != null && $height != null) {
                $imageFile->resize($width, $height)->stream();
            }
            // resize image when width is not null & height is null
            if($width != null && $height === null) {
                $imageFile->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->stream();
            }
            // resize image when width is null & height is not null
            if($width === null && $height != null) {
                $imageFile->resize(null, $height, function ($constraint) {
                    $constraint->aspectRatio();
                })->stream();
            }
            // resize image when width is not null & height is 0 means no change of height
            if($width != null && $height === 0) {
                $imageFile->resize($width, null)->stream();
            }
            // resize image when width is 0 means no change & height is not null
            if($width === 0 && $height != null) {
                $imageFile->resize(null, $height)->stream();
            }
            // upload or store image in the particular storage directory
            $uploadedFile = Storage::disk($storageName)->put($imageName, $imageFile);

            $imageFile->destroy(); // free the memory that intervention was using
            unset($uploadedFile); // same here since it contains the entire jpg as a string

            // if thumbnail request

            if($thumbnail['thumbStorageName'] != null)
            {
                // check existing image
                if($checkImage != null) {
                    $checkImage = $this->reformateCheckImage($checkImage);
                    if (Storage::disk($thumbnail['thumbStorageName'])->has($checkImage)) {
                        Storage::disk($thumbnail['thumbStorageName'])->delete($checkImage);
                    }
                }
                // get the image
                $thumbFile = $encodeType ? Image::make($image)->encode($encodeType) : Image::make($image);
                // resize image when width & height are null
                if($thumbnail['width'] === null && $thumbnail['height'] === null) {
                    $thumbFile->stream();
                }
                // resize image when width & height are not null
                if($thumbnail['width'] != null && $thumbnail['height'] != null) {
                    $thumbFile->resize($thumbnail['width'], $thumbnail['height'])->stream();
                }
                // resize image when width is not null & height is null
                if($thumbnail['width'] != null && $thumbnail['height'] === null) {
                    $thumbFile->resize($thumbnail['width'], null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->stream();
                }
                // resize image when width is null & height is not null
                if($thumbnail['width'] === null && $thumbnail['height'] != null) {
                    $thumbFile->resize(null, $thumbnail['height'], function ($constraint) {
                        $constraint->aspectRatio();
                    })->stream();
                }
                // resize image when width is not null & height is 0 means no change of height
                if($thumbnail['width'] != null && $thumbnail['height'] === 0) {
                    $thumbFile->resize($thumbnail['width'], null)->stream();
                }
                // resize image when width is 0 means no change & height is not null
                if($thumbnail['width'] === 0 && $thumbnail['height'] != null) {
                    $thumbFile->resize(null, $thumbnail['height'])->stream();
                }
                // upload or store image in the particular storage directory
                $uploadedFile = Storage::disk($thumbnail['thumbStorageName'])->put($imageName, $thumbFile);

                $thumbFile->destroy(); // free the memory that intervention was using
                unset($uploadedFile); // same here since it contains the entire jpg as a string
            }

            return $imageName;

        }else{
            return 'No image found';
        }
    }

    public function shapeMaker($shape = null, $width = null, $height = null)
    {
        $getWidth = $getHeight = null;
        if($shape != null)
        {
            if($shape == 'square') {
                $getWidth = $getHeight = 900;
            }elseif($shape == 'potrait') {
                $getWidth = 600;
                $getHeight = 900;
            }elseif($shape == 'landscape') {
                $getWidth = 900;
                $getHeight = 600;
            }elseif($shape == 'custom') {
                $getWidth = $width;
                $getHeight = $height;
            }
        }

        return ['width' => $getWidth, 'height' => $getHeight];
    }

    public function reformateCheckImage($checkImage)
    {
        if(strpos($checkImage, "http://") !== false){
            $reformCheckImage = explode('/', $checkImage);
            $checkImage = $reformCheckImage[count($reformCheckImage) - 1];
        }

        return $checkImage;
    }
}