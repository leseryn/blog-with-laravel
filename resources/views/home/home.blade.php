@extends('layout.main')

@section('title')
	- Login or Register
@endsection



@section('content')

	@if(session()->has('user_id'))

		@include('home.homeLogin')

	@else

		@include('home.homeForm')

		

	@endif


@endsection
