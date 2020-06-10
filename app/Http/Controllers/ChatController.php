<?php

namespace App\Http\Controllers;

use App\Events\MessageSendEvent;
use App\Message;
use App\Room;
use Illuminate\Http\Request;


/**
 * Class ChatController
 * @package App\Http\Controllers
 */
class ChatController extends Controller
{

    /**
     * ChatController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('home');
    }


    /**
     * @param Room $room
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMessage(Room $room){

    return view('room',['room'=>$room]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function sendMessage(Request $request){
        if($request->has('message')&& $request->has('localTime')&& $request->has('timezone')) {

            auth()->user()->messages()->create([
                'message' => $request->message,
                'localTime' => $request->localTime,
                'timezone' => $request->timezone,
            ]);

            broadcast(new MessageSendEvent($request->all()))->toOthers();
        }
        return ['status' => 'fail'];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function joinRoom1(){
        if(!auth()->user()->rooms->contains(1)) {
            auth()->user()->rooms()->attach([1]);
        }

        return redirect("home");
    }


    /**
     * @return string
     */
    public function fetchMessages()
    {

        return   Message::with('user.profile')->get()->toJson();

    }

}
