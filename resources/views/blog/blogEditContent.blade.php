@vite('resources/js/editpost.js')
<div >
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div >
    	
    		<form  action="/blog/edit/{{$id}}/submit" id="blogpost" name="blogpost" method="post" enctype="multipart/form-data">
            @csrf
            {{method_field('put')}} 
    		<p>Title:</p>
    		<textarea  name="title" cols="92" rows="1" >{{$title}}</textarea>
    
    		<p>Summary:</p>
    		<textarea name="summary" cols="92" rows="2" >{{$summary}}</textarea>
    
    		 <p>Content:</p>
    		<textarea  name="content" cols="92" rows="15" >{{$content}}</textarea>

            <!-- <input type="file" class="form-control" name="images[]" multiple/> -->
             <button type="submit" name="save" class="btn">save</button>

             <div class="custom-file-container" data-upload-id="myUniqueUploadId"></div>
             
    		</form>
            <button  id="savepost" name="savepost" class="btn">save and post</button>
            @if($id==='new')
                <a  href="/blog" id="exit" name="exit" class="btn">exit</a>
            @else
                <a  href="/blog/article/{{$id}}" id="exit" name="exit" class="btn">exit</a>
            @endif

    </div>

@if(isset($images))
    @foreach($images as $image)
        <img hidden src="{{$image->image_path}}">
        <div name='oldImages' data-filename='{{$image->filename}}' data-imagepath='{{$image->image_path}}'/>
    @endforeach
@endif

    
<!-- <button  id="btn">Click Me!</button> -->