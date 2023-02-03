<div class="container py-3">
	@auth
	<div class="position-relative">
            <a id="edit-profile" name="edit" class="btn position-absolute top-50 end-0 translate-middle-y">edit</a>
    </div>
    @endauth
	<div class="row text-center" id="user-profile-content">
		
		<div class="col m-3" style="clip-path: circle(6em at center);">
			@if($image)
			<img src="{{asset($image)}}" style="width: 12em;">
			@else
			<img src="images/profile-default.jpg" style="width: 12em;">
			@endif
			
		</div>

		<div class="col-md-12 text-center">
			<h3>{{$name}}</h3>
			
		</div>

		<div class="col-md-12">
			{{$intro}}
		</div>




    

</div>