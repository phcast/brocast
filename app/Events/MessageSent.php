<?php

namespace App\Events;

use App\User;
use App\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    
    /**
     * User that sent the message
     *
     * @var User
     */
    public $user;
    
    /**
     * Message details
     *
     * @var Message
     */
    public $message;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, ChatMessage $message)
    {
        $this->user = $user;
        $this->message = $message;
    }
    
    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat');
    }
}
