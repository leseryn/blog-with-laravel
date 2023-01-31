<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
class LikePostEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $postId = null;
    protected $likes = null;

    public function __construct($userId,$postId)
    {
        // if (session()->has('user_id')){
        //     $sessionUserId = session->get('user_id');
        //     if($sessionUserId===$userId){
        //         Cache::forget("likePosts-{$userId}");
        //     }
        // }
        $this->postId = $postId;
        $this->likes = \App\Models\UserLikePost::where('post_id',$postId)->count();
    }


    public function broadcastOn()
    {
        return new Channel('public.likepost');
    }

    public function broadcastAs(){

        return 'likepost';
    }

    public function broadcastWith(){

        return [
            'postId'=>$this->postId,
            'likes'=>$this->likes,
        ];
    }
}
