<div class="post-load" name="post-load" id="post-load-{{$post->id}}">
    <div class="p-2">
        <div class="position-relative">
            <a  name="exit-btn" class="exit-btn position-absolute top-0 start-100" style="transform:translate(-100%);">
                    <svg width="30" height="30"><use href="/sprite.svg#circle-x"></use></svg>
            </a>
        </div>
        <div class="row m-1 shadow-sm p-3 rounded "  style="background: #f4f4f4;">

            
            <div class="col-md-8 scroll">
                @if(count($images)>0)
                 @include('blog.blogImageSliderLoad')
                 @endif
                 @include('blog.blogText')
            </div>

                
            <div class="col-md-4 scroll">
                @include('blog.blogComment')
            </div>
        </div>
            
    </div>
</div>
