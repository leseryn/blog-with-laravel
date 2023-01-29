@vite('resources/js/postcomment.js')

<div class="container">
    <div class="row ">
        <h3>Comments</h3>
    </div>
    <div class="card shadow-sm">

            <div class="comment">
                <form  action="/blog/article/{{$post->id}}/comment"  method="post">
                    @csrf 
                    {{method_field('put')}} 
                    <textarea  name="comment"></textarea>
                    <button class="btn">send</button>
                </form>
            </div>
        

        <ul class="list-unstyled">

            @if(empty($comments))
                <div>no comment yet</div>
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



