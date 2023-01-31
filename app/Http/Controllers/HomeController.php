<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;

class HomeController extends Controller{
	function showIndex(Request $request){

		if(session()->has('user_id')){
			return redirect()->to('/blog');
		}

		return view('/home/home',['message'=>$request->input('message')]);
	}
}