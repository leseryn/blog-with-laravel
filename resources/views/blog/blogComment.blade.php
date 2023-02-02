@vite('resources/js/postcomment.js')

<div class="container py-3">
    <div class="row ">
        <h4>Comments</h4>
    </div>
    <div class="card shadow-sm">

            <div class="comment comment-text">
                <form  action="/blog/article/{{$post->id}}/comment"  method="post">
                    @csrf 
                    {{method_field('put')}} 
                    <textarea class="form-control" name="comment"></textarea>
                    <button class="btn">send</button>
                </form>
            </div>
        

        <ul class="list-unstyled">

            @if(empty($comments))
                <div class="px-4">no comment yet</div>
            @else($comments)
                @foreach($comments as $comment)
                <li> 
                    @include('blog.blogCommentContent')

                </li>
                @endforeach

            @endif

        </ul>

    </div>
</div>



