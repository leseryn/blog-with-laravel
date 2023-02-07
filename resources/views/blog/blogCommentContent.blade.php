<div class="comment" id="comment-{{$comment->id}}">


    <div class="comment-heading">
        <img class="comment-user-img" src="{{asset($comment->user->profile_image_path)}}" >
        <div class="comment-info flex-grow-1">
            <a href="{{url('/'.$comment->user->name)}}" class="comment-user">{{$comment->user->display_name}}</a>
            <p class="comment-time">{{$comment->created_at}}</p>
        </div>

        @if($authId===$comment->user_id || $deletePermission)
        <div class="align-self-start btn" name="delete-comment">X</div>
        @endif

    </div>

    <div class="comment-body">
        <div class="">
            <x-markdown >
                {{$comment->comment}}
            </x-markdown>
        </div>
        <ul class="list-inline">
            <li class="list-inline-item px-2" name="reply-icon">

                    <svg width="20" height="20"><use  href="/sprite.svg#reply-icon"></use></svg>

            </li>
        </ul>
    </div>

    @if (is_null($comment->parent_id))
    <div class="comment-div replies">

            @if($comment->childComments()->exists())

                <div class="d-flex justify-content-end">
                    <div class="comment-hide"  name="hide" style="display: none;">hide</div>
                    <div class="comment-load">more...</div>
                </div>

            @endif
    </div>
    @endif

</div>


