<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Blog\BlogListController;
class HomeController extends Controller{
	function showIndex(Request $request){

		$blogList = new BlogListController();
		return $blogList->showBlogList($request);

		
	}
}