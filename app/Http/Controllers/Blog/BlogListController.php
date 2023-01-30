<?php
namespace App\Http\Controllers\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Cache;

class BlogListController extends Controller{


	function showBlogList(Request $request){

		// Cache::store('redis')->flush();
		$posts = BlogPost::with('author:id,name')
					->where('published','=',1)
					->orderBy('created_at', 'desc')

					->cursorPaginate(5);

		if($request->ajax()){

			return view('/blog/blogListContent', ['posts'=>$posts]);
	
		}
		return view('/blog/blogList',["posts"=>$posts]);
	}


}
