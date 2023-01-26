<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;

class HomeController extends Controller{
	function showIndex(Request  $request){

		return view('/home/home',['message'=>$request->input('message')]);
	}
}