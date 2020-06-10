<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatisticsMail extends Mailable
{
    use Queueable, SerializesModels;





    public $profileName;

    public $usersCount;

    public $messagesCount;

    public $profilesCount;

    public $messagesUser;

    public $userProfileCount;

    /**
     * Create a new message instance.
     *
     * @param $profileName
     * @param $userProfileCount
     * @param $messagesUser
     * @param $usersCount
     * @param $messagesCount
     * @param $profilesCount
     */
    public function __construct( $profileName,$userProfileCount,$messagesUser, $usersCount, $messagesCount, $profilesCount)
    {
        $this->profileName=$profileName;
        $this->userProfileCount=$userProfileCount;
        $this->messagesUser=$messagesUser;
        $this->usersCount=$usersCount;
        $this->messagesCount=$messagesCount;
        $this->profilesCount=$profilesCount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.statisticsEmail')->with(
            [

                'userName' => $this->profileName,
                'userProfileCount'=>$this->userProfileCount,
                'messagesUser'=>$this->messagesUser,
                'usersCount'=>$this->usersCount,
                'messagesCount'=>$this->messagesCount,
                'profilesCount' => $this->profilesCount

            ]
        );
    }
}
