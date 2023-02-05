<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserFollowEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $authorId = null;
    protected $followByCount = null;

    public function __construct($authorId)
    {
        $this->authorId = $authorId;
        $this->followByCount = \App\Models\UserFollow::where('following_user_id',$authorId)->count();
    }


    public function broadcastOn()
    {
        return new Channel('public.userfollow');
    }

    public function broadcastAs(){

        return 'userfollow';
    }

    public function broadcastWith(){

        return [
            'authorId'=>$this->authorId,
            'followByCount'=>$this->followByCount,
        ];
    }
}
