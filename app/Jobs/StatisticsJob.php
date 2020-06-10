<?php

namespace App\Jobs;

use App\Mail\StatisticsMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class StatisticsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;

    public $usersCount;

    public $messagesCount;

    public $profilesCount;

    public $messagesUser;

    public $userProfileCount;

    public $profileName;


    /**
     * Create a new job instance.
     *
     * @param $email
     * @param $profileName
     * @param $userProfileCount
     * @param $messagesUser
     * @param $usersCount
     * @param $messagesCount
     * @param $profilesCount
     */
    public function __construct($email, $profileName,$userProfileCount ,$messagesUser ,$usersCount, $messagesCount, $profilesCount)
    {

        $this->email=$email;
        $this->profileName=$profileName;
        $this->userProfileCount=$userProfileCount;
        $this->messagesUser=$messagesUser;
        $this->usersCount=$usersCount;
        $this->messagesCount=$messagesCount;
        $this->profilesCount=$profilesCount;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new StatisticsMail( $this->profileName,$this->userProfileCount,$this->messagesUser ,$this->usersCount, $this->messagesCount, $this->profilesCount));
    }
}
