@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <p>{{ $message }}</p>
@endif
@if (isset($message))
<div><p>{{ $message }}please login!!申請成功，請登入</p></div>
@endif
<div>
	<form action="/register" method="post">

		<input type="text" name="name" placeholder="name" value="{{old('name')}}">
		<input type="text" name="email" placeholder="email" value="{{old('email')}}">
		<input type="password" name="password" placeholder="password">
		<button type="submit" > Register </button>
	
	</form>
</div>

<div>
	<form action="/login" method="post">
		@csrf 
		<input type="text" name="email" placeholder="email">
		<input type="password" name="password" placeholder="password">

		<button type="submit" > Login </button>
	
	</form>
</div>