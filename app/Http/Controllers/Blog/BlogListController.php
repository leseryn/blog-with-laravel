<?php
namespace App\Http\Controllers\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\UserLikePost;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class BlogListController extends Controller{

	protected function showBlogList(Request $request){



		if(Auth::check()){
			$userId = Auth::user()->id;
			$posts = BlogPost::addSelect(['user_like'=>UserLikePost::select('user_id')->where('user_id',$userId)->whereColumn('post_id','blog_post.id')])
					->with(['author:id,name',])
					->where('published','=',1)
					->orderBy('created_at', 'desc')
					->paginate(5);
		}
		else{
			$posts = BlogPost::with(['author:id,name',])
					->where('published','=',1)
					->orderBy('created_at', 'desc')
					->paginate(5);
		}

		if($request->ajax()){

			return view('/blog/blogListContent', ['posts'=>$posts]);
	
		}
		return view('/blog/blogList',["posts"=>$posts]);
	}


}
