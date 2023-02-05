
<div class="post-load col-md-12 p-0 position-fixed top-8 start-50 translate-middle-x" name="post-load" id="post-load-{{$post->id}}" style="width:90%;z-index: 1000;position: absolute;top: 50%;">

            <div class="position-relative">
<!--                 <a name="exit-btn" class="exit-btn position-absolute top-0 start-100 " style="transform:translate(-20%);z-index: 1001;">
                    <svg width="30" height="30"><use href="/sprite.svg#circle-x"></use></svg>
                </a> -->
                
            </div>

        <div class=" m-1 shadow-sm p-2 rounded"  style="background: #f4f4f4;">

            <div style="background: #eae9e9;border-radius: 0.5em;">
            
    <div class="scroll">
            @include('blog.blogPostContent')
        
            @include('blog.blogComment')
            </div>
        </div>
    </div>
</div>