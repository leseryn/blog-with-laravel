<?php
namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\PostComment;

use Illuminate\Support\Facades\Cache;
use Storage;
class BlogPostController extends Controller{

	// function showBlogPost(Request $request, $postId){


	// 	$post = BlogPost::with(['user:id,name,profile_image_path','likes'])
	// 			->where('id','=',$postId)->first();
	// 	$images = $post->images()->select('image_path')->get()->all();
	// 	$comments = $post->comments()->orderBy('created_at','asc')->get()->all();
	// 	$likes = $post->likes()->count();
	// 	// dd($likes);
	// 	$binding=[
	// 		'post'=>$post,
	// 		'images'=>$images,
	// 		'comments'=>$comments,
	// 		'likes'=>$likes,
	// 	];
	// 	// dd($binding['comments']);

	// 	return view('/blog/blogPost', $binding);


	// }

	var $showComments=3;

	function showBlogPost(Request $request, $postId){


		$post = BlogPost::with(['user:id,name,profile_image_path','likes'])
				->where('id','=',$postId)->first();
		$images = $post->images()->select('image_path')->get()->all();
		$comments = $post->comments()
					->orderBy('created_at','desc')
					->simplePaginate($this->showComments);
					// ->reverse();
		
		// $commentsTotal = $comments->total();
		// $commentsMore = $comments->hasMorePages();
		// $comments = $comments->reverse();
		// dd($comments->currentPage());
		$likes = $post->likes()->count();
		// dd($likes);
		$binding=[
			'post'=>$post,
			'images'=>$images,
			'comments'=>$comments->reverse(),
			'hasMorePages'=>$comments->hasMorePages(),
			'likes'=>$likes,
		];
		// dd($binding['comments']);

		return view('/blog/blogPost', $binding);

	}

	public function loadComment($parentId,$lastId){
		if($parentId==="none"){
			// $a = PostComment::where('id',$lastId)->first()->post_id;
			// dd($a);
			$comments = PostComment::
				where('post_id', PostComment::where('id',$lastId)->first()->post_id)
				->where('parent_id', null)
				->where('id','<',$lastId)
				->orderBy('created_at','desc')
				->simplePaginate($this->showComments);
			// dd($comments);
			$binding=[
				'type'=>"main",
				'comments'=>$comments->reverse(),
			];
			// return view('/blog/blogCommentLoad',$binding);

		}else{

			if($lastId==="none"){
				$comments = PostComment::
				where('parent_id', $parentId)
				->orderBy('created_at','desc')
				->simplePaginate($this->showComments);
			}else{
				$comments = PostComment::
				where('parent_id', $parentId)
				->where('id','<',$lastId)
				->orderBy('created_at','desc')
				->simplePaginate($this->showComments);
			}
			$binding=[
				'type'=>"replies",
				'comments'=>$comments->reverse(),
			];


		}

		$data=[
			'view'=>view('/blog/blogCommentLoad',$binding)->render(),
			'hasMorePages'=>$comments->hasMorePages(),
			// 'last'=>$lastId,
			// 'parent'=>$parentId,
		];
		// dd($data);
		return response()->json($data, 200);
	}

}
