<?php
namespace App\Http\Controllers\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\PostImage;
use Illuminate\Support\Facades\Cache;
use Storage;
use Image;
use Validator;
class BlogEditController extends Controller{


	function showBlogEdit($postId){
		
		if ($postId==='new'){
			$post = [
				'id'=>'new',
				'title'=>'',
				'summary'=>'',
				'content'=>'',
			];
		}else{
			$post = Cache::store('redis')->get('post'.$postId);
			$post=null;
			if (is_null($post)){
				$currPost = BlogPost::with('author:id,name')
						->where('id','=',$postId)->first();

				$post = [
					'id'=>$postId,
					'title'=>$currPost->title,
					'summary'=>$currPost->summary,
					'content'=>$currPost->content,
					'images'=>$currPost->images()->select(['filename','image_path'])->get(),
				];
				Cache::store('redis')->put('post'.$postId, $post, 600);
			}
		}

		return view('/blog/blogEdit', $post);

	}

	// function submitpost(Request $request){
	// 	return 'pp';
	// 	return response()->json($request->all());
	// 	return $_POST;
	// 	BlogPost::create([
	// 		'author_id' => '1',
	// 		'title' => 'ttt',
    //   		'summary' => 'ppp',
    //   		'content' => 'ttt',
	// 	]);
	// 	$data = $request->all();
	// 	// return $data['sss'];
	// 	return response()->view('/home/home');
	// }


	function submit(Request $request,$postId){
		// return $postId;

		// return response()->json($request->all());
		$data = $request->all();

		##validation
		$validator = Validator::make($data, [
					'title' =>['required'],
					'images' =>['nullable','max:4'],
					'images.*' =>['image','nullable','max:1024']
				]);

		if($validator->fails()){
			// return redirect("/blog/edit/{$postId}/")->withErrors($validator)->withInput($request->all());
			return response()->json($validator->errors(), 422);
		}

		// update blog_post data
		$updateData = [
			'author_id' => $request->session()->get('user_id'),
			'title' => $data['title'],
      		'summary' => $data['summary'],
      		'content' => $data['content'],
		];

		// create new blog_post data
		if($postId==='new'){
			$postId = BlogPost::create($updateData)->id;
		}else{
			BlogPost::where('id','=',$postId)
			->update($updateData);
		}

		//remove old images
		$oldImages = PostImage::where('post_id','=',$postId)->get();
		foreach($oldImages as $oldImage){
			Storage::disk('images_post')->delete($oldImage->filename);
			$oldImage->forceDelete();
		}
		//store image
		// dd($data);
		if(isset($data['images'])){
			foreach($data['images'] as $image){
				$filename = $image->getClientOriginalName();
				// $filename = $image->originalName;
				// dd($filename);
				$filename = explode(':',$filename)[0];
				$filename = explode('.',$filename);
				$filename = end($filename);
				$filename = time()."_".uniqid().".{$filename}";

				$pathFilename = "/images/post/".$filename;
				Storage::disk('images_post')->put($filename, file_get_contents($image));
				PostImage::create([
					'post_id'=>$postId,
					'image_path'=>$pathFilename,
					'filename' =>$filename,
				]);
				
			}
		}
		return response()->json("/blog/article/{$postId}", 200);

		
	}

	// function submit(Request $request,$postId){

	// 	$data = $request->all();

	// 	##validation
	// 	$validator = Validator::make($data, [
	// 				'title' =>['required'],
	// 				'images.*' =>['image','nullable','max:1024']
	// 			]);

	// 	if($validator->fails()){
	// 		return redirect("/blog/edit/{$postId}/")->withErrors($validator)->withInput($request->all());
	// 	}

	// 	## update blog_post data
	// 	$updateData = [
	// 		'author_id' => $request->session()->get('user_id'),
	// 		'title' => $data['title'],
    //   		'summary' => $data['summary'],
    //   		'content' => $data['content'],
	// 	];

	// 	// if(isset($data['save-post'])){
	// 	// 	$updateData['published']='1';
	// 	// }

	// 	## create new blog_post data
	// 	if($postId==='new'){
	// 		$postId = BlogPost::create($updateData)->id;
	// 	}else{
	// 		BlogPost::where('id','=',$postId)
	// 		->update($updateData);
	// 	}

	// 	## store image
	// 	if(isset($data['images'])){
	// 		foreach($data['images'] as $image){
	// 			$filename = $image->getClientOriginalName();
	// 			$filename = time()."_".$filename;
	// 			$pathFilename = "images/post/".$filename;
	// 			Storage::disk('images_post')->put($filename, file_get_contents($image));
	// 			PostImage::create([
	// 				'post_id'=>$postId,
	// 				'image_path'=>$pathFilename,
	// 			]);
	// 		}
	// 	}

	// 	Cache::store('redis')->forget('post'.$postId);

	// 	return redirect("/blog/article/{$postId}");
	// }


}
