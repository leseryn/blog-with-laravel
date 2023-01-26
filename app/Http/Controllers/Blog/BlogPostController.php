<?php
namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Cache;
use Storage;
class BlogPostController extends Controller{

	function showBlogPost(Request $request, $postId){


		$post = null;

		if (is_null($post)){

			$post = BlogPost::with('author:id,name')
					->where('id','=',$postId)->first();
			$images = $post->images()->select('image_path')->get();

		}


		return view('/blog/blogPost', ['post'=>$post]);


	}


}
