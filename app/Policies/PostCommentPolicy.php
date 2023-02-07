<?php

namespace App\Policies;
use App\Models\PostComment;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function delete(User $user, PostComment $postComment)
    {

        $commentUserId = $postComment->user_id;
        $postAuthorId = $postComment->post()->first()->user_id;
        $userId = $user->id;
        if($userId ===$commentUserId  || $userId ===$postAuthorId ){
            return Response::allow();
        }else{
            return Response::deny('permission denied');
        }

    }
}
