    <div class="container">
        @if(session()->has('user_id'))
            <a href="/blog/edit/{{$post->id}}">edit</a>
        @endif

        <div>
            <h2>{{$post->title}}</h2>
        </div>
        <div>
            <h3>{{$post->created_at}}, {{$post->author->name}}</h3>
        </div>
        <div>{{$post->summary}}</div>

        <div>{{$post->content}}</div>

        @if(!empty($images))
            @foreach($images as $image)

                <img class="img-thumbnail" src='{{asset("{$image->image_path}")}}'/>

            @endforeach
        @endif

         
     

    </div>

