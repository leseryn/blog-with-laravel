@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif





<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card px-5 py-5" id="form1">

<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">login</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab">Register</button>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="login" role="tabpanel">
        <div class="form-data" >
            <div class="forms-inputs my-4">
            	<form  action="/login" method="post">
            		@csrf
	            	<label>Email</label>
	                	 <div class="mb-3">
	                	 	<input class="form-control" type="text" name="email" placeholder="email" value="{{old('email')}}">
	                	 </div>
	            	  
	                 <label>Password</label>
	                	 <div class="mb-3">
	                	 	<input class="form-control" type="password" name="password" placeholder="password" >
	                	 </div>
	                <div class="mb-3"> 
	                	<button type="submit" class="btn btn-dark w-100 mt-3"> Login </button>
	                </div>
            	</form>
            </div>

        </div>
  	</div>


  <div class="tab-pane fade" id="register" role="tabpanel">
		<div class="form-data" >
	        <div class="forms-inputs my-4">
	        	<form  action="/register" method="post">
	        		@csrf
		        	<label>Email</label>
		            	 <div class="mb-3">
		            	 	<input class="form-control" type="text" name="email" placeholder="email" value="{{old('email')}}">
		            	 </div>
		        	  <label>Name</label>
		            	 <div class="mb-3">
		            	 	<input class="form-control" type="text" name="name" placeholder="name" value="{{old('name')}}">
		            	 </div>
		             <label>Password</label>
		            	 <div class="mb-3">
		            	 	<input class="form-control" type="password" name="password" placeholder="password" >
		            	 </div>
		            <div class="mb-3"> 
		            	<button type="submit" class="btn btn-dark w-100 mt-3"> Register </button>
		            </div>
	        </form>
	        </div>

	    </div>
  	</div>
</div>

            </div>
        </div>
    </div>
</div>






