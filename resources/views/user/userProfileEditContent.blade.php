		<div class="col-md-12 position-absolute top-15 start-50 translate-middle-x" id="edit-profile-div" style="display: none;">

			
			<div class="m-3 shadow p-3 mb-5 rounded" style="background: #9f8f8f;opacity:0.9;">

					<a id="exit-edit" name="exit-edit" class="position-absolute top-0 start-100 " style="transform:translate(-100%);">
						<svg width="30" height="30"><use href="/sprite.svg#circle-x"></use></svg>
					</a>
				
				<div class="row text-start">
					<div class="col text-center">
						@if($image)
							<img id="profile-edit-image-preview" src="{{asset(image)}}" >
						@else
							<img id="profile-edit-image-preview" src="images/profile-default.jpg" style="border-radius: 50%;width: 8em;">
						@endif
					</div>
		    		<form  action="#" id="blogpost" name="blogpost" method="post" enctype="multipart/form-data">
		            @csrf
		            {{method_field('put')}} 
		            <div class="col">
		            	<label class="form-label">Profile Image Upload:</label>
		            	<input class="form-control" type="file"/>  
		            </div>

		    			<label class="form-label">Introduction:</label>

		            <div class="col">
		    			<textarea  class="form-control" name="profile_text" rows="2" style="width: 100%"></textarea>
		            </div>
		    		</form>

		            <button  id="savepost" name="savepost" class="btn">save</button>

		        </div>

				<img hidden scr=""/>
			
			</div>
		</div>