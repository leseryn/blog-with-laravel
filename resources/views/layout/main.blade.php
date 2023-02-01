<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TestProject @yield('title')</title>
	@vite (['resources/js/app.js', 'resources/sass/app.scss'])
	@vite('resources/css/plus.css')

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/blog">A_A</a>
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbars">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse collapse" id="navbars" style="">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          
<!--           <li class="nav-item">
            <a class="nav-link" href="/blog">Blog</a>
          </li> -->
          @auth
	          <li class="nav-item">
	            <a class="nav-link"  href="/logout">Logout</a>
	          </li>
          @else
	          <li class="nav-item">
	            <a class="nav-link"  href="/">Login</a>
	          </li>
          @endauth
        </ul>

      </div>

    </div>
</nav>

	

	

	<div class="container-fuild p-3">

		@yield('content')
		
	</div>

	<footer>
		 This is footer:)))
	</footer>



</body>
</html>