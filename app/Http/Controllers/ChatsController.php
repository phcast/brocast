<?php

namespace App\Http\Controllers;

use App\ChatMessage;
use Illuminate\Http\Request;
use App\Events\MessageSent;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('chat');
    }
    
    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        return ChatMessage::with('user')->get();
    }
    
    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = \Auth::user();
        
        $message = $user->chatMessage()->create([
            'message' => $request->input('message')
        ]);
        //dd($message->message);
        broadcast(new \App\Events\MessageSent($user, $message))->toOthers();
    
        return ['status' => 'Message Sent!'];
    }
}
