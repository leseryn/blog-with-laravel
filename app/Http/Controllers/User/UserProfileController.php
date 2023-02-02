<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    protected function showProfile(){
        $userInfo = Auth::user();
        $binding = [
            'name'=>$userInfo->name,
            'intro'=>$userInfo->profile_text,
            'image'=>$userInfo->profile_image_path,
        ];

        return view('/user/userProfile',$binding);
    }

    protected function showEdit(){
        $userInfo = Auth::user();
        $binding = [
            'name'=>$userInfo->name,
            'intro'=>$userInfo->profile_text,
            'image'=>$userInfo->profile_image_path,
        ];
        return view('/user/userProfileEditContent',$binding);
    }
}
