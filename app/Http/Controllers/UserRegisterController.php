<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Hash;
class UserRegisterController extends Controller{
	function register(Request $request){


		// $ressult = $request->validate([
		// 	'name' =>['required'],
		// 	'email' => ['required','unique:users', 'email'],
		// 	'password' =>['required','min:6','max:12']
		// ]);
		$data = $request->all();
		$validator = Validator::make($data, [
			'name' =>['required'],
			'email' => ['required','unique:users', 'email'],
			'password' =>['required','min:6','max:12']
		]);
		
		if($validator->fails()){
			return redirect('/')->withErrors($validator)->withInput($request->all());
		}

		User::create([
			'name' =>$data['name'],
			'email' => $data['email'],
			'password' =>Hash::make($data['password'])
		]);
		return redirect()->route('show-home',['message'=>'successfully_registered']);
	}

	function login(Request $request){
		$data = $request->all();
		$validator = Validator::make($data, [
			'email' => [ 'email']
		]);

		if($validator->fails()){
			return redirect('/')->withErrors($validator)->withInput($request->all());
		}
		$user = User::where('email',$data['email'])->first();
		if($user && Hash::check($data['password'], $user['password'])){
			$request->session()->put('user_id', $user->id);
		}

		return redirect('/');
	}

	function logout(Request $request){
		
		session()->forget('user_id');

		return back();
	}
}