<?php

namespace AdopteUnIench\Http\Controllers;

use AdopteUnIench\Conversation;
use AdopteUnIench\Match;
use AdopteUnIench\Message;
use AdopteUnIench\Profile;
use AdopteUnIench\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function index() {

        $profile_id = User::find(Auth::user()->id)->profile_id;

        $matches_1 = Match::where('profile_id_1', $profile_id)->pluck('profile_id_2')->toArray();
        $matches_2 = Match::where('profile_id_2', $profile_id)->pluck('profile_id_1')->toArray();

        $messages_1 = Message::where('receiver_id', $profile_id)->pluck('sender_id')->toArray();
        $messages_2 = Message::where('sender_id', $profile_id)->pluck('receiver_id')->toArray();

        $conversations = [];

        $matches = array_merge($matches_1, $matches_2);
        $messages = array_merge($messages_1, $messages_2);

        foreach ($matches as $match) {
            if (in_array($match, $messages))
                array_push($conversations, Profile::find($match));
        }

        return view('message/messenger', ['conversation' => $conversations]);
    }

    protected function discuss(Request $request) {

        $friend_profile_id = $request->query('profile_id');

        $profile_id = User::find(Auth::user()->id)->profile_id;

        $messages_1 = Message::where([['receiver_id', $profile_id], ['sender_id', $friend_profile_id]])->get();
        $messages_2 = Message::where([['sender_id', $profile_id], ['receiver_id', $friend_profile_id]])->get();

        $messages = [];

        foreach ($messages_1 as $msg) {
            array_push($messages, $msg);
        }

        foreach ($messages_2 as $msg) {
            array_push($messages, $msg);
        }

        usort($messages, array($this, 'cmp'));

        return view('message/conversation', ['messages' => $messages, 'profile' => Profile::find($profile_id), 'friend_profile' => Profile::find($friend_profile_id)]);
    }

    protected function sendMessage(Request $request) {

        Message::create([
            'sender_id' =>  User::find(Auth::user()->id)->profile_id,
            'receiver_id' => (int) $request->input('friend_id'),
            'message' => $request->input('message')
        ])->push();

        return back();

    }

    private function cmp ($a, $b) {
        return strcmp($a->sendDateTime, $b->sendDateTime);
    }
}
