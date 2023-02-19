<?php
namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\UserResource;
class UserRegisterController extends Controller{
	public function __construct()
    {
        $this->middleware('guest');
    }

	protected function register(Request $request){

		$data = $request->all();
		$validator = Validator::make($data, [
			'name' =>['required','unique:users','min:4','max:16','alpha_dash:ascii'],
			'email' => ['required','unique:users', 'email'],
			'password' =>['required','min:6','max:16']
		]);
		
		if($validator->fails()){
			return redirect('/login')->withErrors($validator)->withInput($request->all());
		}

		User::create([
			'name' =>$data['name'],
			'display_name'=>uniqid('sloth_'),
			'email' => $data['email'],
			'password' =>Hash::make($data['password'])
		]);
		Cache::forget('users');
		Cache::rememberForever('users', function () {
			return UserResource::collection(User::all())->except([2,3,4,5]);
		});
		return redirect()->route('/login',['message'=>'successfully registered, login now!']);
	}

}