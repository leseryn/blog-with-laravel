<?php
namespace App\Http\Controllers\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\PostImage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use Storage;
use Image;
use Validator;
class BlogEditController extends Controller{


	protected function showBlogEdit($postId){

		if ($postId==='new'){

			$post = [
				'id'=>'new',
				'title'=>'',
				'summary'=>'',
				'content'=>'',
			];
		}else{
			
			$currPost = BlogPost::with('user:id,name')
					->where('id','=',$postId)->first();
			if (!$currPost){
				return redirect()->route('/');
			}
			

			$post = [
				'id'=>$postId,
				'title'=>$currPost->title,
				'summary'=>$currPost->summary,
				'content'=>$currPost->content,
				'images'=>$currPost->images()->select(['filename','image_path'])->get(),];

			
		}

		return view('/blog/blogEdit', $post);

	}

	protected function delete(Request $request,$postId){
		$currPost = BlogPost::where('id',$postId)->first();;
		Gate::authorize('delete-post', $currPost);
		$currPost->delete();
		return response()->json('deleted...', 200);
	}


	protected function submit(Request $request,$postId){

		$data = $request->all();
		// validation
		$validator = Validator::make($data, [
					'title' =>['required'],
					'images' =>['nullable','max:4'],
					'images.*' =>['image','nullable','max:1024']
				]);

		if($validator->fails()){

			return response()->json($validator->errors(), 422);
		}

		// update blog_post data
		$updateData = [
			'title' => $data['title'],
      		'summary' => $data['summary'],
      		'content' => $data['content'],
      		'published'=>1,
		];

		// create new blog_post data
		if($postId==='new'){
			Gate::authorize('create-post');
			$updateData['user_id']=Auth::user()->id;
			$postId = BlogPost::create($updateData)->id;
			
		}else{
		// update blog_post data
			$currPost = BlogPost::where('id',$postId)->first();

			Gate::authorize('update-post', $currPost);
			
			$currPost->update($updateData);
		}

		//remove old images
		$oldImages = PostImage::where('post_id','=',$postId)->get();
		foreach($oldImages as $oldImage){
			Storage::disk('images_post')->delete($oldImage->filename);
			$oldImage->forceDelete();
		}
		
		//store image
		if(isset($data['images'])){
			foreach($data['images'] as $image){
				$filename = $image->getClientOriginalName();
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




}
