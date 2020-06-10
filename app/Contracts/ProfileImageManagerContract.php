<?php


namespace App\Contracts;


use App\Profile;

/**
 * Interface profileImageManagerContract
 * @package App\Contracts
 */
interface ProfileImageManagerContract
{
    /**
     * @return mixed
     */
    public function storeProfileImage();

    /**
     * @param Profile $profile
     * @return mixed
     */
    public function updateProfileImage(Profile $profile);

    /**
     * @param Profile $profile
     * @return mixed
     */
    public function deleteProfileImage(Profile $profile);


}
