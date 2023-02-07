@vite('resources/js/postcomment.js')

<div class="container py-3" >
    <div class="row ">
        <h4>Comments</h4>
    </div>
    <div class="card shadow-sm">

            <div class="comment-text">
                <form  action="/blog/article/{{$post->id}}"  method="post">
    
                    @if($authId)
                    <div hidden name="authcheck"></div>
                    @csrf 
                    @endif
                    {{method_field('put')}} 
                    <textarea class="form-control" name="comment"></textarea>
                    <div class="btn m-1" name="submit-comment">send</div>

                </form>


            </div>

            <div class="comment-div main-comment"> 

                @if($hasMorePages)
                <div class="d-flex justify-content-end">
                    <div class="comment-hide" name="hide" style="display: none;">hide</div>
                    <div class="comment-load">more...</div>
                </div>
                
                @endif


                @if(empty($comments))
                    <div class="px-4">no comment yet</div>
                @else($comments)
                    @foreach($comments as $comment)

                        @include('blog.blogCommentContent')

                    @endforeach

                @endif
        </div>

    </div>
</div>



