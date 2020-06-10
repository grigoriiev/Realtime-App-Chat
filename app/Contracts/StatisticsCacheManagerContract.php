<?php


namespace App\Contracts;


use App\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface iStatisticsCacheManager
 * @package App\Contracts
 */
interface StatisticsCacheManagerContract
{

    /**
     * @param User $user
     * @param $profile
     * @return mixed
     */
    public function userProfileCount(User $user, $profile);


    /**
     * @param User $user
     * @param $messagesUser
     * @return mixed
     */
    public function messagesUserCount(User $user, $messagesUser);


    /**
     * @param Collection $users
     * @return mixed
     */
    public function usersCount(Collection $users );


    /**
     * @param Collection $rooms
     * @return mixed
     */
    public function roomsCount(Collection $rooms );


    /**
     * @param Collection $messages
     * @return mixed
     */
    public function messagesCount(Collection $messages);


    /**
     * @param Collection $profiles
     * @return mixed
     */
    public function profilesCount(Collection $profiles);


}
