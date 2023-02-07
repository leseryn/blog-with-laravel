
@extends('layout.main')



@section('title')
	someone
@endsection



@section('content')

	@vite('resources/js/bloguser_profile.js')
	@vite('resources/js/postlist.js')
	
	@include('user.userProfileContent')

    <div class="row py-4 row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="post-content">

		@include('blog.blogListContent')
	
    </div>

@endsection