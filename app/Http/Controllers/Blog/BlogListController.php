<?php
namespace App\Http\Controllers\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\UserLikePost;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class BlogListController extends Controller{

	var $showPosts = 20;

	protected function showLobby(Request $request){

		return $this->showBlogList($request, false);

	}

	public function showBlogList(Request $request, $followOnly=true){
		$login = Auth::check();

		// if login show the following blog posts
		if($followOnly && $login){
			$userId = Auth::user()->id;
			$userfollow = Auth::user()->follow()->get('following_user_id')->toArray();
			array_push($userfollow,$userId);
			$posts = BlogPost::addSelect(['user_like'=>UserLikePost::select('user_id')->where('user_id',$userId)->whereColumn('post_id','blog_post.id')])
					->withCount('likes')
					->withCount('commentsAll')
					->with(['user:id,display_name,name',])
					->whereIn('user_id',$userfollow)
					->where('published','=',1)
					->orderBy('created_at', 'desc')
					->paginate($this->showPosts);
		
		}elseif($login){
			$userId = Auth::user()->id;
			$userfollow = Auth::user()->follow()->get('following_user_id')->toArray();
			$posts = BlogPost::addSelect(['user_like'=>UserLikePost::select('user_id')->where('user_id',$userId)->whereColumn('post_id','blog_post.id')])
					->withCount('likes')
					->withCount('commentsAll')
					->with(['user:id,display_name,name',])
					->where('published','=',1)
					->orderBy('created_at', 'desc')
					->paginate($this->showPosts);
		
		}else{
			$posts = BlogPost::with(['user:id,display_name,name',])
					->withCount('likes')
					->withCount('commentsAll')
					->where('published','=',1)
					->orderBy('created_at', 'desc')
					->paginate($this->showPosts);
			

		}

		// dd($posts);

		if($request->ajax()){

			return view('/blog/blogListContent', ['posts'=>$posts]);
	
		}
		return view('/blog/blogList',["posts"=>$posts]);
	}

	protected function showLikes(Request $request){


		if(!Auth::check()){
			return redirect('/');
		}
		$userId = Auth::user()->id;
		$posts = BlogPost::addSelect(['user_like'=>UserLikePost::select('user_id')->where('user_id',$userId)->whereColumn('post_id','blog_post.id')])
			->with(['user:id,display_name',])
			->withCount('likes')
			->withCount('commentsAll')
			->whereRelation('likes', 'user_id', '=', $userId)
			->where('published','=',1)
			->orderBy('created_at', 'desc')
			->paginate($this->showPosts);
		// dd($posts);
		if($request->ajax()){

			return view('/blog/blogListContent', ['posts'=>$posts]);

		}
		return view('/blog/blogList',["posts"=>$posts]);

	}

	protected function showSearch(Request $request){

		$search = $request->q;
		
		if($search[0]=="@"){
			$search = ltrim($search,'@');
			if(Auth::check()){
				$userId = Auth::user()->id;
				$posts = BlogPost::addSelect(['user_like'=>UserLikePost::select('user_id')->where('user_id',$userId)->whereColumn('post_id','blog_post.id')])
						->with(['user:id,display_name',])
						->withCount('likes')
						->withCount('commentsAll')
						->where('published','=',1)
						->whereRelation('user','name','like','%'.$search.'%')
						->orderBy('created_at', 'desc')
						->paginate($this->showPosts);
			}
			else{
				$posts = BlogPost::with(['user:id,name',])
						->withCount('likes')
						->withCount('commentsAll')
						->where('published','=',1)
						->whereRelation('user','name','like','%'.$search.'%')
						->orderBy('created_at', 'desc')
						->paginate($this->showPosts);
			}
			// dd($posts);
		}else{
			if(Auth::check()){
				$userId = Auth::user()->id;
				$posts = BlogPost::addSelect(['user_like'=>UserLikePost::select('user_id')->where('user_id',$userId)->whereColumn('post_id','blog_post.id')])
						->with(['user:id,display_name',])
						->withCount('likes')
						->withCount('commentsAll')
						->where('published','=',1)
						->where('title','like','%'.$search.'%')
						->orWhere('summary','like','%'.$search.'%')
						->orWhere('content','like','%'.$search.'%')
						->orderBy('created_at', 'desc')
						->paginate($this->showPosts);
			}
			else{
				$posts = BlogPost::with(['user:id,name',])
						->withCount('likes')
						->withCount('commentsAll')
						->where('published','=',1)
						->where('title','like','%'.$search.'%')
						->orWhere('summary','like','%'.$search.'%')
						->orWhere('content','like','%'.$search.'%')
						->orderBy('created_at', 'desc')
						->paginate($this->showPosts);
			}

		}


		if($request->ajax()){

			return view('/blog/blogListContent', ['posts'=>$posts]);
	
		}
		return view('/blog/blogList',["posts"=>$posts]);

	}

	protected function showUserPost(Request $request, $authorName){

		if(Auth::check()){

			$userId = Auth::user()->id;
			$posts = BlogPost::addSelect(['user_like'=>UserLikePost::select('user_id')->where('user_id',$userId)->whereColumn('post_id','blog_post.id')])
				->whereRelation('user','name','=',$authorName)
				->withCount('likes')
				->withCount('commentsAll')
				->withOnly(['user:id,display_name,profile_image_path,profile_image_path'])
				->where('published','=',1)
				->orderBy('created_at', 'desc')
				->paginate($this->showPosts);


		}else{

			$posts = BlogPost::whereRelation('user','name','=',$authorName)
				->withCount('likes')
				->withCount('commentsAll')
				->withOnly(['user:id,display_name,profile_image_path,profile_image_path'])
				->where('published','=',1)
				->orderBy('created_at', 'desc')
				->paginate($this->showPosts);
		}
		



		if($request->ajax()){

			return view('/blog/blogListContent', ['posts'=>$posts]);
	
		}

		// with author info

		// $authorInfo = User::with(['followBy' => function ($query) {
		//     $query->where('user_id', Auth::user()->id);
		// }])->where('name',$authorName)->first();

		// $authorInfo = User::with(['followBy:following_user_id,user_id'])->where('name',$authorName)->first();

		



		if(isset($userId)){
			$authorInfo = User::with(['followBy' => function ($query) {
		    $query->where('user_id', Auth::user()->id);}])
			->withCount('followBy')
			->where('name',$authorName)->first();
			if($userId===$authorInfo->id){
				$userIsAuthor = true;
			}else{
				$userIsAuthor = false;
			}
			
		}else{ 
			$authorInfo = User::withCount('followBy')
			->where('name',$authorName)->first();
			$userIsAuthor = false;
		}

// dd($authorInfo);
		$binding = [
			'posts'=>$posts,
			'name'=>$authorName,
            'displayName'=>$authorInfo->display_name,
            'intro'=>$authorInfo->profile_text,
            'image'=>$authorInfo->profile_image_path,
            'userFollowAuthor'=>$authorInfo->followBy->isNotEmpty(),
            'followByCount'=>$authorInfo->follow_by_count,
            'userIsAuthor'=>$userIsAuthor,
        ];

        // dd($binding);
		return view('/blog/blogUser',$binding);

	}




}
