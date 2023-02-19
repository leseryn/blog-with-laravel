<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Http\Resources\UserResource;

use Illuminate\Support\Facades\Cache;
class BlogNavSearchController extends Controller {
	//

	private $users;

	public function __construct() {
		// Cache::forget('users');
		$this->users = Cache::rememberForever('users', function () {

			return UserResource::collection(User::all())->except([2,3,4,5]);
		});

	}

	protected function searchMatch() {

		return response()->json(['data'=>$this->users], 200);
        
	}
}
