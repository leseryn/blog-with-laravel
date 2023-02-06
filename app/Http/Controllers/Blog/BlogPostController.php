<?php
namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\PostComment;
use Illuminate\Support\Facades\Cache;
use Storage;
class BlogPostController extends Controller{

	var $showComments=3;

	function showBlogPost(Request $request, $postId){

		$post = BlogPost::where('id','=',$postId)->first();
			
		$images = $post->images()->select('image_path')->get()->all();
		$comments = $post->comments()
					->orderBy('created_at','desc')
					->simplePaginate($this->showComments);
					// ->reverse();
		
		$likes = $post->likes()->count();

		$binding=[
			'post'=>$post,
			'images'=>$images,
			'comments'=>$comments->reverse(),
			'hasMorePages'=>$comments->hasMorePages(),
			'likes'=>$likes,

		];

		if($request->ajax()){

			$data=[
				'view'=>view('/blog/blogPostLoad', $binding)->render(),
			];

			return response()->json($data, 200);
		}
		// return view('/blog/blogPostLoad', $binding);
		return view('/blog/blogPost', $binding);

	}

	public function loadComment($parentId,$lastId){
		if($parentId==="none"){
			$comments = PostComment::
				where('post_id', PostComment::where('id',$lastId)->first()->post_id)
				->where('parent_id', null)
				->where('id','<',$lastId)
				->orderBy('created_at','desc')
				->simplePaginate($this->showComments);
			$binding=[
				'type'=>"main",
				'comments'=>$comments->reverse(),
			];

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
		];
		return response()->json($data, 200);
	}


	public function loadImageSlider($postId){

		$images = BlogPost::withOnly(['images'])
			->where('id','=',$postId)->first()->images()->select('image_path')->get()->all();

		// dd($images);
		$binding = ['images'=>$images];
		return view('/blog/blogImageSliderLoad',$binding);
		$data = [
			'view'=> view('/blog/blogImageSliderLoad',$binding)->render(),
		];


	}

}
