<div class="py-3">
        @if(Auth::user()->id===$post->user_id)
        <div class="position-relative">
            <a type="button" href="/blog/edit/{{$post->id}}" class="btn position-absolute top-50 end-0 translate-middle-y" >edit</a>
        </div>
        @endif

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

     
</div>