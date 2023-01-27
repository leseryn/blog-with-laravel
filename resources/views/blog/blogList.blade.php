@extends('layout.main')

@section('title')
	BLOG!List!
@endsection



@section('content')

 @vite('resources/js/postlist.js')
    @if(session()->has('user_id'))
            <a href="/blog/edit/new">new article</a>
    @endif

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="post-content">
		@include('blog.blogListContent')
	
    </div>

@endsection

<div class="ajax-load" style="display:none">
	<p><img src="{{asset('images/loader.gif')}}"/></p>
	
</div>

