<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ImageUpload extends Controller
{
    public function avatarUploadPost()

    {

        request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);



        $imageName = Auth::id().'.png';



        request()->image->move(public_path('img/user_avatars'), $imageName);



        return back()

            ->with('success','You have successfully upload image.')

            ->with('image',$imageName);

    }
}
