@foreach ($posts as $post)
    <div class="col">
        @csrf
        <div class="card shadow-sm post-card-content"  id="postid-{{$post->id}}" >
            @if(isset($post->images[0]))
                <img class="bd-placeholder-img card-img-top" src='{{$post->images[0]->image_path}}'/>
            @endif
            <div class="card-body">
                <p class="card-text">{{ $post->title }}</p>
                <p class="card-text">{{ $post->title }}{{$post->summary}}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
<!-- <form action="/blog/article/4/cancel-like " method="post">
    @csrf
    <button type="submit">fff</button>
</form>   -->           @if($post->user_like)
                            <a type="button" class="btn btn-sm btn-outline-secondary" name="like-button-cancel" style=' display: flex;'>
                            <div>
                                <svg width="20" height="20">
                                    <use class="like-icon" href="/sprite.svg#heart-fill-icon"></use></svg>
                            </div>
                        @else
                            <a type="button" class="btn btn-sm btn-outline-secondary" name="like-button" style=' display: flex;'>
                            <div>
                                <svg width="20" height="20">
                                    <use class="like-icon" href="/sprite.svg#heart-icon"></use></svg>
                            </div>
                            
                        @endif
                        <div name="like-button-count">{{$post->likes_count}}</div>
                        </a>

                        
                        <a type="button" name="comment-button" class="btn btn-sm btn-outline-secondary d-flex">
                            <div>
                                <svg width="20" height="20">
                                    <use href="/sprite.svg#comment"></use></svg>
                            </div>
                            <div name="comment-button-count">{{$post->comments_count}}</div>

                        </a>
                        @auth
                        @if(Auth::user()->id===$post->user_id)
                        <a type="button" class="btn btn-sm btn-outline-secondary" href="/blog/edit/{{$post->id}}">Edit</a>
                        @endif
                        @endauth
                      
                    </div>
                    <small class="text-muted">{{$post->created_at->diffForHumans()}}, <a href="/{{$post->user->name}}">{{$post->user->display_name}}</a></small>
                </div>
            </div>

        </div>
    </div> 
@endforeach

@if($posts->nextPageUrl())
<nav aria-label="Pagination Navigation" >
<a rel="next-page" href="{{$posts->nextPageUrl()}}"></a>
</nav>
@endif


            




