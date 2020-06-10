<?php


namespace App\Services;



use App\Contracts\StatisticsCacheManagerContract;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Class CacheManager
 * @package App\Service
 */
class CacheManager implements StatisticsCacheManagerContract
{
    /**
     * @param $user
     * @param $profile
     * @return mixed
     */
    public function userProfileCount(User $user, $profile){

        return Cache::remember(
            'count.userProfile.' . $user->id,
            now()->addSeconds(30),
            function () use ($profile) {
                return $profile->user->rooms()->count();
            });
    }

    /**
     * @param $user
     * @param $messagesUser
     * @return mixed
     */
    public function messagesUserCount(User $user, $messagesUser){
        return Cache::remember(
            'count.messagesUser.' . $user->id,
            now()->addSeconds(30),
            function () use ($messagesUser) {
                return $messagesUser->count();
            });
    }

    /**
     * @param $users
     * @return mixed
     */
    public function usersCount(Collection $users ){
        return Cache::remember(
            'count.users',
            now()->addSeconds(30),
            function () use ($users ) {
                return $users->count();
            });
    }

    /**
     * @param $rooms
     * @return mixed
     */
    public function roomsCount( Collection $rooms ){
        return Cache::remember(
            'count.rooms',
            now()->addSeconds(30),
            function () use ($rooms ) {
                return $rooms ->count();
            });
    }

    /**
     * @param $messages
     * @return mixed
     */
    public function messagesCount(Collection $messages){
        return Cache::remember(
            'count.messages',
            now()->addSeconds(30),
            function () use ($messages)  {
                return $messages->count();
            });
    }

    /**
     * @param $profiles
     * @return mixed
     */
    public function profilesCount(Collection $profiles){
        return Cache::remember(
            'count.profiles.',
            now()->addSeconds(30),
            function ()  use ($profiles) {
                return $profiles->count();
            });
    }
}
