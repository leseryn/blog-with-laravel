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

		$showPosts = 15;

		if(Auth::check()){
			$userId = Auth::user()->id;
			$posts = BlogPost::addSelect(['user_like'=>UserLikePost::select('user_id')->where('user_id',$userId)->whereColumn('post_id','blog_post.id')])
					->with(['author:id,name',])
					->where('published','=',1)
					->orderBy('created_at', 'desc')
					->paginate($showPosts);
		}
		else{
			$posts = BlogPost::with(['author:id,name',])
					->where('published','=',1)
					->orderBy('created_at', 'desc')
					->paginate($showPosts);
		}

		if($request->ajax()){

			return view('/blog/blogListContent', ['posts'=>$posts]);
	
		}
		return view('/blog/blogList',["posts"=>$posts]);
	}

	protected function showLikes(Request $request){

		$showPosts = 15;

		if(!Auth::check()){
			return redirect('/');
		}
		$userId = Auth::user()->id;
		$posts = BlogPost::addSelect(['user_like'=>UserLikePost::select('user_id')->where('user_id',$userId)->whereColumn('post_id','blog_post.id')])
			->with(['author:id,name',])
			->whereRelation('likes', 'user_id', '=', $userId)
			->where('published','=',1)
			->orderBy('created_at', 'desc')
			->paginate($showPosts);
		// dd($posts);
		if($request->ajax()){

			return view('/blog/blogListContent', ['posts'=>$posts]);

		}
		return view('/blog/blogList',["posts"=>$posts]);

	}

	protected function showSearch(Request $request){

		$showPosts = 15;
		$search = $request->q;

		if(Auth::check()){
			$userId = Auth::user()->id;
			$posts = BlogPost::addSelect(['user_like'=>UserLikePost::select('user_id')->where('user_id',$userId)->whereColumn('post_id','blog_post.id')])
					->with(['author:id,name',])
					->where('published','=',1)
					->where('title','like','%'.$search.'%')
					->orWhere('summary','like','%'.$search.'%')
					->orWhere('content','like','%'.$search.'%')
					->orderBy('created_at', 'desc')
					->paginate($showPosts);
		}
		else{
			$posts = BlogPost::with(['author:id,name',])
					->where('published','=',1)
					->where('title','like','%'.$search.'%')
					->orWhere('summary','like','%'.$search.'%')
					->orWhere('content','like','%'.$search.'%')
					->orderBy('created_at', 'desc')
					->paginate($showPosts);
		}

		if($request->ajax()){

			return view('/blog/blogListContent', ['posts'=>$posts]);
	
		}
		return view('/blog/blogList',["posts"=>$posts]);

	}

	protected function showUserPost(Request $request){
		$showPosts = 15;
		$userId = Auth::user()->id;
		$posts = BlogPost::addSelect(['user_like'=>UserLikePost::select('user_id')->where('user_id',$userId)->whereColumn('post_id','blog_post.id')])
				->with(['author:id,name',])
				->where('published','=',1)
				->where('author_id','=',$userId)
				->orderBy('created_at', 'desc')
				->paginate($showPosts);

		if($request->ajax()){

			return view('/blog/blogListContent', ['posts'=>$posts]);
	
		}
		return view('/blog/blogList',["posts"=>$posts]);

	}




}
