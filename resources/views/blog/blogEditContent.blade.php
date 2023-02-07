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

    <div class=" py-3">
        <div class="d-flex justify-content-end" >
            @if($id==='new')
                <a  href="/blog" id="exit" name="exit" class="btn">exit</a>
            @else
                <a href="/blog/article/{{$id}}" id="exit" name="exit" class="btn">exit</a>
                <a id="delete" name="delete-{{$id}}" class="btn">delete</a>
<!--                 <form action="/blog/edit/{{$id}}/delete" method="post">
                    @csrf<button type="submit">ddd</button>
                </form> -->
            @endif
        </div>
    	<div class="row">
    		<form  action="/blog/edit/{{$id}}/submit" id="blogpost" name="blogpost" method="post" enctype="multipart/form-data">
            @csrf
            {{method_field('put')}} 
            <div class="col">
    		<label>Title:</label>
            </div>
            <div class="col">
    		<textarea  class="form-control" name="title" rows="2" style="width: 100%">{{$title}}</textarea>
            </div>
    		<p>Summary:</p>
    		<textarea class="form-control" name="summary" rows="2" style="width: 100%">{{$summary}}</textarea>
    
    		 <p>Content:</p>
    		<textarea  class="form-control" name="content"  rows="15" style="width: 100%" >{{$content}}</textarea>

            <!-- <input type="file" class="form-control" name="images[]" multiple/> -->
             <button type="submit" name="save" class="btn">save</button>
             <div class="custom-file-container" data-upload-id="myUniqueUploadId"></div>
    
    		</form>

            <button  id="savepost" name="savepost" class="btn">save and post</button>

        </div>
    </div>

@if(isset($images))
    @foreach($images as $image)
        <img hidden src="{{$image->image_path}}">
        <div name='oldImages' data-filename='{{$image->filename}}' data-imagepath='{{$image->image_path}}'/>
    @endforeach
@endif


<!-- <button  id="btn">Click Me!</button> -->