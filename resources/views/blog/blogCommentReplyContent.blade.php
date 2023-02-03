<div class="comment comment-reply" id="comment-{{$comment->id}}">

    <div class="comment-heading">
        <img class="comment-user-img" src="{{asset($comment->user->profile_image_path)}}" >
        <div class="comment-info">
            <a href="#" class="comment-user">{{$comment->user->name}}</a>
            <p class="comment-time">{{$comment->created_at}}</p>
        </div>

    </div>

    <div class="comment-body">
        <p class="text">{{$comment->comment}}</p>
        <ul class="list-inline">

            <li class="list-inline-item px-2">
                <a name="reply-comment" href="#comment-{{$comment->parent_id}}" >
                    <svg width="20" height="20"><use class="reply-icon" href="/sprite.svg#reply-icon"></use></svg>
                </a>
            </li>
        </ul>
        <div id="comment-{{$comment->id}}-reply" style="display:none">
            <form action="/blog/article/{{$post->id}}/comment/{{$comment->parent_id}}"  method="post">
                @csrf 
                {{method_field('put')}} 
                <textarea class="form-control" name="comment"></textarea>
                <button class="btn m-2">send</button>
            </form>
        </div>

    </div>

</div>


