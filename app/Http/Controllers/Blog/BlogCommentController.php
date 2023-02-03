<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;

class BlogCommentController extends Controller
{
    public function create(Request $request, $postId, $commentId=null){
        $data = $request->all();
        $updateData = [
            'comment'=>$data['comment'],
            'user_id'=>Auth::user()->id,
            'post_id'=>$postId,
            'parent_id'=>$commentId,
        ];

        $commentId =  PostComment::create($updateData)->id;

        return redirect()->to("/blog/article/{$postId}#comment-{$commentId}");
        
    }


    public function delete(){

    }

    public function edit(){

    }
}
