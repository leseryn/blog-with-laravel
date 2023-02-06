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

<nav class="navbar py-0 m-0 navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/blog">
      	<svg width="40" height="40"><use class="reply-icon" href="/sprite.svg#sloth"></use></svg>
      </a>
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
	            <a class="nav-link"  href="/blog/likes">Likes</a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link"  href="/blog/edit/new">New Post</a>
	          </li>


          @else
	          <li class="nav-item">
	            <a class="nav-link"  href="/">Login</a>
	          </li>
          @endauth
          	</ul>

 
           <form action="/blog/search" id="search-form" class="mb-2 mb-lg-0" method="get" style="display: none;">
          <input id="search-text" class="form-control" type="text" placeholder="Search" aria-label="Search" name="q">
        </form>
        <svg id="search-icon" class="mx-2 mb-lg-0" width="30" height="30"><use class="reply-icon" href="/sprite.svg#search"></use></svg>
        


        @auth

        <div class="navbar-nav">
					  <a class="nav-link dropdown-toggle "  data-bs-toggle="dropdown" aria-expanded="false">
					    <img class="comment-user-img mb-0" src="{{Auth::user()->profile_image_path}}" style="border-radius: 50%;width: 3em;"/>
					  </a>
					  <ul class="dropdown-menu dropdown-menu-end mb-2">
						    <li><a class="dropdown-item" href="/{{Auth::user()->name}}">My Post</a></li>
						    <li><a class="dropdown-item" href="/logout">Logout</a></li>
					  </ul>
				</div>

        @endauth

        

        

      </div>

    </div>
</nav>


	<div class="container-fuild p-3">

		@yield('content')
		
	</div>

<!-- 	<footer hidden>
		 This is footer:)))
		 I have no Footer:(((
	</footer> -->



</body>
</html>