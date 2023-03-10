@extends('layout.main')

@section('title')
	Blog
@endsection



@section('content')

 @vite('resources/js/postlist.js')

         @if($errors->any())
             <div class="alert alert-danger">
                 <ul>
                     @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                 </ul>
             </div>
         @endif



    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="post-content">




		@include('blog.blogListContent')
	
    </div>

@endsection

<div class="ajax-load" style="display:none">
	<p><img src="{{asset('images/loader.gif')}}"/></p>
	
</div>

