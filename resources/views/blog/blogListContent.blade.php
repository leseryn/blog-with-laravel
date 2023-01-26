    @if(session()->has('user_id'))
            <a href="/blog/edit/new">new article</a>
    @endif

    <div class="container">
        <ul>
        @foreach ($posts as $post)
            <div>
                <h2>{{ $post->title }}</h2>
                
                <p>{{$post->created_at}}, {{$post->author->name}}</p>

                <div>
                    {{$post->summary}}
                </div>
                <a href="/blog/article/{{$post->id}}">read more...</a>

                @if(session()->has('user_id'))
                    <a href="/blog/edit/{{$post->id}}">edit</a>
                @endif
            </div>
                
            

        @endforeach
        </ul>

        @if($posts->currentPage()!=$posts->onFirstPage())
            <a href="{{$posts->previousPageUrl()}}">prev</a>
        @endif
        @if($posts->currentPage()!=$posts->lastPage())
            <a href="{{$posts->nextPageUrl()}}">next</a>
        @endif

    </div>