<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{
	function showIndex(Request $request){

		if(Auth::check()){
			return redirect()->to('/blog');
		}

		return view('/home/home',['message'=>$request->input('message')]);
	}
}