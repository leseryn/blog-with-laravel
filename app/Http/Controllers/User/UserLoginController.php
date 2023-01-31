<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Hash;

class UserLoginController extends Controller{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

	protected function login(Request $request){
		// $data = $request->all();
		// $validator = Validator::make($data, [
		// 	'email' => [ 'email']
		// ]);

		// if($validator->fails()){
		// 	return redirect('/')->withErrors($validator)->withInput($request->all());
		// }
		// $user = User::where('email',$data['email'])->first();
		// if($user && Hash::check($data['password'], $user['password'])){
		// 	$request->session()->put('user_id', $user->id);
		// }
		$data = $request->except(['_token']);
	
        $validator =  Validator::make($data, [
	        'email' => ['required', 'email'],
	        'password' => ['required'],
    	]);

        if($validator->fails()){
        	return redirect('/')->withErrors($validator)->withInput($request->except(['_token']));
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

		return redirect('/');
	}
}