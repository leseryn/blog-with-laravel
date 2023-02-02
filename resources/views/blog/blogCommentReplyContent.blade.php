<div class="comment" id="comment-{{$comment->id}}">
        <a href="#comment-1" class="comment-border-link">
        </a>

    <div class="comment-heading">
        <img class="comment-user-img" src="https://img.icons8.com/bubbles/100/000000/groups.png" >
        <div class="comment-info">
            <a href="#" class="comment-user">{{$comment->user->name}}</a>
            <p class="comment-time">{{$comment->created_at}}</p>
        </div>

    </div>

    <div class="comment-body">
        <p class="text">{{$comment->comment}}</p>
        <ul class="list-inline">

            <li class="list-inline-item px-2">
                <a name="reply-comment" href="#comment-{{$comment->id}}" >
                    <svg width="20" height="20"><use class="reply-icon" href="/sprite.svg#reply-icon"></use></svg>
                </a>
            </li>
        </ul>
        <div id="comment-{{$comment->id}}-reply" style="display:none">
            <form action="/blog/article/{{$post->id}}/comment/{{$comment->id}}"  method="post">
                @csrf 
                {{method_field('put')}} 
                <textarea name="comment"></textarea>
                <button class="btn m-2">send</button>
            </form>
        </div>

    </div>

</div>


