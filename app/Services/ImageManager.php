<?php


namespace App\Services;


use App\Contracts\profileImageManagerContract;
use App\Profile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Class ImageManagerContract
 * @package App\Service
 */
class ImageManager implements ProfileImageManagerContract
{

    /**
     * @return mixed
     */
    public function storeProfileImage(){

        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->resize(50, 50);
        $image->save();
      return $imagePath ;
    }

    /**
     * @param Profile $profile
     * @return array
     */
    public function updateProfileImage(Profile $profile){

        Storage::delete('public/'.$profile->image);
        $imagePath = request('image')->store('uploads','public');

        $image = Image::make(public_path("storage/{$imagePath}"))->resize(50, 50);
        $image->save();

        $imageArray = ['image' => $imagePath];
        return $imageArray;
    }

    /**
     * @param Profile $profile
     */
    public function deleteProfileImage(Profile $profile){


        Storage::delete('public/'.$profile->image);
        return;

    }

}
