<div class="container py-3">

	@if($userIsAuthor)
	<div class="position-relative">
            <a id="edit-profile" name="edit" class="btn position-absolute top-50 end-0 translate-middle-y">edit</a>
    </div>
    @endif
    	

    


	<div class="row text-center" id="user-profile-content">
		
		<div class="col m-1" style="clip-path: circle(6em at center);">
			@if($image)
			<img src="{{asset($image)}}" style="width: 12em;">
			@else
			<img src="images/profile-default.jpg" style="width: 12em;">
			@endif
			
		</div>

		<div class="col-md-12 d-inline-flex justify-content-center">
			<div class="m-2">
				<h3>{{$displayName}}</h3>
			</div>
			<div >
            	<a id="following" class="btn d-flex">
	            	<div>
	            		@Auth
	            			@csrf
	            		@endauth
	            		@if($userFollowAuthor)
	            		<svg width="30" height="30"><use href="/sprite.svg#unfollow"></use></svg>
	            		@else
	            		<svg width="30" height="30"><use  href="/sprite.svg#follow"></use></svg>
	            		@endif
	            	</div>

	            	<div class="m-1" name="following-count">
	            		{{$followByCount}}
	            	</div>
            	</a>
    		</div>
<!-- <form action="/ramen/follow" method="post">
	@csrf
	<button type="submit"></button>
</form> -->
		</div>

		<div class="col-md-12 ">
			{{$intro}}
		</div>




    

</div>