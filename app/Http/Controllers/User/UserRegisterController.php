<?php
namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Hash;
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
			return redirect('/')->withErrors($validator)->withInput($request->all());
		}

		User::create([
			'name' =>$data['name'],
			'display_name'=>'sloth_'.uniqid(),
			'email' => $data['email'],
			'password' =>Hash::make($data['password'])
		]);
		return redirect()->route('/',['message'=>'successfully registered, login now!']);
	}

}