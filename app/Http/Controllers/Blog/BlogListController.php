<?php
namespace App\Http\Controllers\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\UserLikePost;
use Illuminate\Support\Facades\Cache;

class BlogListController extends Controller{

	public $likePosts=null;

	public function __construct(){

		// if (session()->has('user_id')){
		// 	$userId = session->get('user_id');
		// 	$this->likePosts = Cache::remeber("likePosts-{$userId}",15,function() {
		// 		return UserLikePost::where('user_id',$userId);
		// 	});		
		// 	}	
		// dd(session());
	}


	protected function showBlogList(Request $request){
		
	
		$posts = BlogPost::with('author:id,name')
					->where('published','=',1)
					->orderBy('created_at', 'desc')
					->Paginate(5);
					// ->cursorPaginate(5);

		if($request->ajax()){

			return view('/blog/blogListContent', ['posts'=>$posts]);
	
		}
		return view('/blog/blogList',["posts"=>$posts,"likePosts"=>$this->likePosts]);
	}


}
