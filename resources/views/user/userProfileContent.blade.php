<div class="container py-3">
	@auth
	<div class="position-relative">
            <a id="edit-profile" name="edit" class="btn position-absolute top-50 end-0 translate-middle-y">edit</a>
    </div>
    @endauth
	<div class="row text-center" id="user-profile-content">
		
		<div class="col-md-12 m-3">
			@if($image)
			<img class="" src="{{asset(image)}}" >
			@else
			<img class="" src="images/profile-default.jpg" style="border-radius: 50%;width: 8em;">
			@endif
			
		</div>
		<div class="col-md-12 m-3">
			<h3>{{$name}}</h3>
			
		</div>
		<div class="col-md-12 m-3">
			{{$intro}}
		</div>


@vite('resources/js/profileedit.js')

    

</div>