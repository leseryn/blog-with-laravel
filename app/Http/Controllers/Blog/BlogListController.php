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

					->paginate(5);
		// dd($posts);
		// Cache::store('redis')->put('posts', $posts, 600);
		

		// $posts = BlogPost::with('author')->select('title','summary','publishedDate')->get();
		// dd($posts);
		// foreach($posts as $post){
		// 	dd($post);
		// }
		



		return view('/blog/blogList',["posts"=>$posts]);
	}


}
