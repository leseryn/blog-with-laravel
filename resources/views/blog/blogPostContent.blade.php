    <div class="container py-3">
        @auth
        <div class="position-relative p-2">
            <a type="button" href="/blog/edit/{{$post->id}}" class="btn position-absolute top-50 end-0 translate-middle-y" >edit</a>
        </div>
        @endauth
        <div class="p-2">
            <div>
                <h2>{{$post->title}}</h2>
            </div>
            <div>
                <h5>{{$post->created_at}}, {{$post->user->name}}</h5>
            </div>
            <div>
                <x-markdown >

                    {{$post->summary}}
                    
                </x-markdown>
            </div>

            <div>
                <x-markdown >

                    {{$post->content}}

                </x-markdown>
            </div>

            @if(!empty($images))
                @foreach($images as $image)

                    <img class="img-thumbnail" src='{{asset("{$image->image_path}")}}'/>

                @endforeach
            @endif

        </div>         
     

    </div>

