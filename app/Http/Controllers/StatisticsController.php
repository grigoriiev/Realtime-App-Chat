<?php

namespace App\Http\Controllers;


use App\Contracts\StatisticsCacheManagerContract;
use App\Jobs\StatisticsJob;
use App\Message;
use App\Profile;
use App\Room;

use App\User;



/**
 * Class StatisticsController
 * @package App\Http\Controllers
 */
class StatisticsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * @param User $user
     * @param StatisticsCacheManagerContract $CacheManager
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(User $user,StatisticsCacheManagerContract  $CacheManager)
    {
        $this->authorize('view',$user);

        $statistics=$this->getStatistics($user, $CacheManager);
        return view('statistics.index', ['email' => $statistics['email'], 'profileName'=>$statistics['profileName'],'userProfileCount'=>$statistics['userProfileCount'],'messagesUser'=>$statistics['messagesUser'],'usersCount'=>$statistics['usersCount'],'messageCount'=> $statistics['messageCount']
            , 'profilesCount'=>$statistics['profilesCount'],'roomsCount'=>$statistics['roomsCount']]);

    }

    /**
     * @param User $user
     * @param StatisticsCacheManagerContract $CacheManager
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function emailStatistics(User $user,StatisticsCacheManagerContract  $CacheManager)
    {
        $this->authorize('viewEmail',$user);
        $statistics=$this->getStatistics($user,  $CacheManager);
        StatisticsJob::dispatch($statistics['email'], $statistics['profileName'],$statistics['userProfileCount'],$statistics['messagesUser'],$statistics['usersCount'], $statistics['messageCount']
            , $statistics['profilesCount'], $statistics['roomsCount'])->onQueue('statistics.job');
        return redirect('profile')->with('emailSucsses','Youare email sent');
    }

    /**
     * @param $user
     * @param StatisticsCacheManagerContract $CacheManager
     * @return array
     */
    protected function getStatistics($user, StatisticsCacheManagerContract $CacheManager){
        $profileUser = (auth()->user()) ? auth()->user()->profile : false;
        $messagesUser = (auth()->user()) ? auth()->user()->messages() : false;
        $users = User::all();
        $rooms= Room::all();
        $messages = Message::all();
        $profiles = Profile::all();
       // $cacheManager= new CacheManager();
        return[
            'email'=>auth()->user()->email,
            'profileName'=>$profileUser->name,
            'userProfileCount'=>$CacheManager->userProfileCount($user,  $profileUser),
            'roomsCount'=> $CacheManager->roomsCount($rooms),
            'messagesUser'=>$CacheManager->messagesUserCount($user,$messagesUser),
            'usersCount'=> $CacheManager->usersCount($users),
            'messageCount'=> $CacheManager->messagesCount($messages),
            'profilesCount'=>$CacheManager->profilesCount($profiles ),

        ];



    }

}
