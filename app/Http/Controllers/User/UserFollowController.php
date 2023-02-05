<?php

namespace App\Http\Controllers\User;

use App\Models\UserFollow;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use APP\Events\LikePostEvent;
use Illuminate\Support\Facades\Auth;

class UserFollowController extends Controller
{
    public function follow(Request $request, $authorName){

        $userId = Auth::user()->id;
        $authorId = User::where('name',$authorName)->first()->id;
        try{
            $find = UserFollow::withTrashed()
                ->where('user_id',$userId)
                ->where('following_user_id',$authorId)
                ->first();


            if(isset($find)){
                $find->restore();
            }else{
                UserFollow::create([
                'user_id'=>$userId,
                'following_user_id'=>$authorId,
                ]); 
            }
        }catch(e){
            return response()->json(false, 422);
        }

        event(new \App\Events\UserFollowEvent($authorId));

        return response()->json(true, 200);
    }

    public function unfollow(Request $request, $authorName){

        $userId = Auth::user()->id;
        $authorId = User::where('name',$authorName)->first()->id;

        try{

            $find = UserFollow::withTrashed()
                ->where('user_id',$userId)
                ->where('following_user_id',$authorId)->first();
            if($find){
                $find->delete();
            }
            

        }catch(e){
            return response()->json(false, 422);
        }
        event(new \App\Events\UserFollowEvent($authorId));
        return response()->json(true, 200);

    }
}
