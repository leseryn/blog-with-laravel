


<div class="slideshow-container" data-image-count="{{count($images)}}">

      @for($i = 0; $i < count($images); $i++)
      <div class="slides" style="display:none;">
        <div class="numbertext">{{$i+1}} / {{count($images)}}</div>
        <img src="{{asset($images[$i]->image_path)}}" >



      </div>
      @endfor

   @if(count($images)>1)
     
   
    <div class="slideshow-btn-area">
      
      <a class="slideshow-btn slideshow-prev">❮</a>
      <a class="slideshow-btn slideshow-next">❯</a>

    </div>
  @endif


</div>



