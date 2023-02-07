<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Hash;

class UserLoginController extends Controller{

	protected function showLogin(Request $request){
		if(Auth::check()){
			return redirect('/');
		}
		return view('/home/home',['message'=>$request->input('message')]);
	}
	protected function login(Request $request){

		$data = $request->except(['_token']);
	
        $validator =  Validator::make($data, [
	        'email' => ['required', 'email'],
	        'password' => ['required'],
    	]);

        if($validator->fails()){
        	return redirect('/login')->withErrors($validator)->withInput($request->except(['_token']));
        }

		if (Auth::attempt($data)) {
            $request->session()->regenerate();

            return redirect('/');
        }

		return back()->withErrors([
            'email' => 'Wrong email or password',
        ])->onlyInput('email');
	}

	function logout(Request $request){
		
		Auth::logout();
		$request->session()->invalidate();

    	$request->session()->regenerateToken();

		return redirect('/login');
	}
}