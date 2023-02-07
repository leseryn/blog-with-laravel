<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class BlogCommentController extends Controller
{
    public function create(Request $request, $postId, $commentId=null){

        $authId = null;
        $deletePermission=false;
        if(Auth::check()){
            $authId = Auth::user()->id;
        }
        $data = $request->all();
        $updateData = [
            'comment'=>$data['comment'],
            'user_id'=>$authId,
            'post_id'=>$postId,
            'parent_id'=>$commentId,
        ];


        $comment = PostComment::create($updateData);

        if ($authId == $comment->post()->first()->user_id){
            $deletePermission = true;
        }

        $binding =[
            'authId'=>$authId,
            'deletePermission'=>$deletePermission,
            'comment'=>$comment
        ];

        // return view('/blog/blogCommentContent', $binding);
        $data = [
            'view'=>view('/blog/blogCommentContent', $binding)->render(),
            'commentId'=>$comment->id,
        ];

        return response()->json($data, 200);

        
    }


    public function delete(Request $request, $commentId){
        $currComment = PostComment::where('id',$commentId)->first();;
        Gate::authorize('delete-comment', $currComment);
        $childComments = $currComment->childComments()->delete();
        $currComment->delete();

        return response()->json('deleted', 200);
    }

    public function edit(){

    }
}
