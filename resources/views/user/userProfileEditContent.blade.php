		<div class="col-md-12 position-absolute top-15 start-50 translate-middle-x" id="edit-profile-div" style="display: none; z-index: 1000;">

			
			<div class="m-3 shadow p-3 mb-5 rounded" id="edit-profile-indiv" style="background: #9f8f8f;opacity:0.9;">

					<a id="exit-edit" name="exit-edit" class="exit-btn position-absolute top-0 start-100 " style="transform:translate(-100%);">
						<svg width="30" height="30"><use href="/sprite.svg#circle-x"></use></svg>
					</a>
				
				<div class="row text-start">
					<div class="col text-center" style=" clip-path: circle(6em at center);">
						@if($image)
							<img id="profile-edit-image-preview" src="{{asset($image)}}" style="width: 12em;">
						@else
							<img id="profile-edit-image-preview" src="images/profile-default.jpg" style="width: 12em;">

						@endif
					</div>

		    		<form  action="/user/edit/submit" id="profile-edit-form" method="post" enctype="multipart/form-data">
		            @csrf
		            {{method_field('put')}} 
		            <div class="col my-3">
		            	<label class="form-label">Profile Image Upload:</label>
		            	<input class="form-control" id="profile-image-upload" name="image" type="file" />  
		            </div>
		            <div class="col my-3">
		    			<label class="form-label">Name:</label>
		    			<input  class="form-control" name="display_name" value="{{$name}}"></input>
		            </div>
		            <div class="col my-3">
		    			<label class="form-label">Introduction:</label>
		    			<textarea  class="form-control" name="text" rows="2" style="width: 100%">{{$intro}}</textarea>
		            </div>
<!-- <button type="submit"> SAVVVVE</button> -->
		    		</form>
		    		<div class="col my-3 text-center">
		            	<a  id="save-profile" name="save-profile" class="btn">save</a>
		            </div>

		        </div>

			
			</div>
		</div>