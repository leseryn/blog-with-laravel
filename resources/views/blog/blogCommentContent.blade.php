<div class="comment" id="comment-{{$comment->id}}">
    <!--     <a href="#comment-1" class="comment-border-link">
        </a> -->

    <div class="comment-heading">
        <img class="comment-user-img" src="{{asset($comment->user->profile_image_path)}}" >
        <div class="comment-info">
            <a href="{{url('/'.$comment->user->name)}}" class="comment-user">{{$comment->user->display_name}}</a>
            <p class="comment-time">{{$comment->created_at}}</p>
        </div>
    </div>

    <div class="comment-body">
        <p class="text">{{$comment->comment}}</p>
        <ul class="list-inline">
            <li class="list-inline-item px-2" name="reply-icon">
                <!-- <div class="reply-icon"> -->
                    <svg width="20" height="20"><use  href="/sprite.svg#reply-icon"></use></svg>
                <!-- </div> -->
            </li>
        </ul>
    </div>

    @if (is_null($comment->parent_id))
    <div class="comment-div replies">

            @if($comment->childComment()->exists())

                <div class="d-flex justify-content-end">
                    <div class="comment-hide"  name="hide" style="display: none;">hide</div>
                    <div class="comment-load">more...</div>
                </div>

            @endif
    </div>
    @endif

</div>


