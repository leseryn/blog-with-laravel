@extends('layout.main')


@section('title')
	BLOG!!
@endsection



@section('content')


	@include('blog.blogPostContent')
	
	@include('blog.blogComment')

@endsection