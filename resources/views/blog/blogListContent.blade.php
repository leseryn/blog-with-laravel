@foreach ($posts as $post)
    <div class="col"/>
        <div class="card shadow-sm post-card-content"  id="postid-{{$post->id}}" >
            @if(isset($post->images[0]))
                <img class="bd-placeholder-img card-img-top" src='{{$post->images[0]->image_path}}'/>
            @endif
            <div class="card-body">
                <p class="card-text">{{ $post->title }}</p>
                <p class="card-text">{{ $post->title }}{{$post->summary}}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">

                        <a type="button" class="btn btn-sm btn-outline-secondary" name="like-button" style=' display: flex;'>
                        <div>
                            <svg width="20" height="20">
                                <use class="like-icon" href="/sprite.svg#heart-icon"></use></svg>
                        </div>
                        <div>
                            {{$post->likes->count()}}
                        </div>
                        </a>
                        
                        <a type="button" class="btn btn-sm btn-outline-secondary" href="/blog/article/{{$post->id}}">View</a>
                      @if(session()->has('user_id'))
                        <a type="button" class="btn btn-sm btn-outline-secondary" href="/blog/edit/{{$post->id}}">Edit</a>
                      @endif
                    </div>
                    <small class="text-muted">{{$post->created_at}}, {{$post->author->name}}</small>
                </div>
            </div>

        </div>
    </div> 
@endforeach
<div hidden>
{{$posts->links()}}
</div>


            




