<?php

namespace App\Http\Controllers\User;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rule;
class UserProfileController extends Controller
{
    protected function showProfile(Request $request){
        $userInfo = Auth::user();
        $binding = [
            'name'=>$userInfo->name,
            'intro'=>$userInfo->profile_text,
            'image'=>$userInfo->profile_image_path,
        ];

        // if($request->ajax()){
        //     return view('/user/userProfileEditContent', $binding);
        // }
        // return $request->header();
        return view('/user/userProfile',$binding);
    }

    protected function showEdit(){

        if(!Auth::check()){
            return response()->json(['message' => 'not allowed'], 403);
        }

        $userInfo = Auth::user();
        $binding = [
            'name'=>$userInfo->name,
            'intro'=>$userInfo->profile_text,
            'image'=>$userInfo->profile_image_path,
        ];
        return view('/user/userProfileEditContent',$binding);
    }

    protected function submit(Request $request){

        if(!Auth::check()){
            return response()->json(['message' => 'not allowed'], 403);
        }

        $data = $request->all();

        //validate
        $validator = Validator::make($data, [
                    'image' =>[
                        'nullable',
                        File::image()
                            ->max(1024)
                            ->dimensions(Rule::dimensions()
                            ->maxWidth(300)->maxHeight(300))],
                ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        //store image
        if(isset($data['image'])){
            $imageFilename = $data['image']->getClientOriginalName();
            $imageFilename = time()."_".uniqid().$imageFilename;
            Storage::disk('images_profile')->put($imageFilename, file_get_contents($data['image']));
            //delete old image
            $oldImageFilename = Auth::user()->profile_image_path;
            $oldImageFilename = explode('/',$oldImageFilename);
            $oldImageFilename = end($oldImageFilename);
            Storage::disk('images_profile')->delete($oldImageFilename);
        }



        //update profile
        $updateData = [
            'profile_text'=>$data['text'],
        ];
        if(isset($data['image'])){
            $pathFilename = "/images/profile/".$imageFilename;
            $updateData['profile_image_path'] = $pathFilename;
        }
        User::where('id',Auth::user()->id)->update($updateData);

        return response()->json("/user", 200);
    }
}
