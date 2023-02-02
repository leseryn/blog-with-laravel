    <div class="container py-3">
        @if(session()->has('user_id'))
            <a href="/blog/edit/{{$post->id}}">edit</a>
        @endif
        <div class="position-relative">
            <a type="button" href="/blog/edit/{{$post->id}}" class="btn position-absolute top-50 end-0 translate-middle-y" >edit</a>
        </div>

        <div>
            <h2>{{$post->title}}</h2>
        </div>
        <div>
            <h5>{{$post->created_at}}, {{$post->author->name}}</h5>
        </div>
        <div>{{$post->summary}}</div>

        <div>{{$post->content}}</div>

        @if(!empty($images))
            @foreach($images as $image)

                <img class="img-thumbnail" src='{{asset("{$image->image_path}")}}'/>

            @endforeach
        @endif

         
     

    </div>

