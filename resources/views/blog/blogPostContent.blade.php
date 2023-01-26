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
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">
            <img class="bd-placeholder-img card-img-top" src='http://localhost:8000/images/post/1674530677_0.jpg'/>
            <div class="card-body">
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
          </div>
        </div>
</div>
        @if($post->images)
            @foreach($post->images as $image)

                <img class="img-thumbnail" src='{{asset("{$image->image_path}")}}'/>

            @endforeach
        @endif

   
        
        
        

    </div>