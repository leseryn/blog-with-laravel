@extends('layout.main')

@section('title')
	HOME
@endsection



@section('content')

	@if(session()->has('user_id'))

		@include('home.homeLogin')

	@else

		@include('home.homeForm')

		

	@endif


@endsection
