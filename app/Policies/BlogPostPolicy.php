<?php

namespace App\Policies;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
class BlogPostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, BlogPost $blogPost)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
        return $user->role=="writer"
                ? Response::allow()
                : Response::deny('permission denied');
      
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, BlogPost $blogPost)
    {
        //

        return $user->id === $blogPost->user_id
                ? Response::allow()
                : Response::deny('permission denied');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, BlogPost $blogPost)
    {
        if($user->role==="admin" || $user->id === $blogPost->user_id){
            return Response::allow();
        }else{
            Response::deny('permission denied');
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, BlogPost $blogPost)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, BlogPost $blogPost)
    {
        //
        return $user->id === $blogPost->author_id
                ? Response::allow()
                : Response::deny('permission denied');
    }
}
