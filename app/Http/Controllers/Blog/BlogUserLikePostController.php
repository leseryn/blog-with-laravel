<?php

namespace App\Http\Controllers\User;
use App\Models\UserLikePost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use APP\Events\LikePostEvent;
class BlogUserLikePostController extends Controller
{
    public function likePost(Request $request, $postId){

        $userId = $request->session()->get('user_id');

        try{
            $find = userLikePost::withTrashed()
                ->where('user_id',$userId)
                ->where('post_id',$postId)
                ->first();


            if(isset($find)){
                $find->restore();
            }else{
                userLikePost::create([
                'user_id'=>$userId,
                'post_id'=>$postId,
                ]); 
            }
        }catch(e){
            return response()->json(false, 422);
        }

        event(new \App\Events\LikePostEvent($userId,$postId));

        return response()->json(true, 200);
    }

    public function cancelLikePost(Request $request, $postId){

        $userId = $request->session()->get('user_id');

        try{

            $find = userLikePost::withTrashed()
                ->where('user_id',$userId)
                ->where('post_id',$postId)->first();
            $find->delete();

        }catch(e){
            return response()->json(false, 422);
        }
        event(new \App\Events\LikePostEvent($userId,$postId));
        return response()->json(true, 200);

    }
}
