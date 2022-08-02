<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    
    public function Profile(){

        $user=User::find(auth()->user()->id);
        return view("user.profile",compact("user"));
    }

    public function updateInfo(Request $request){


        $request->validate([
            "name"=>"required|max:16",
            "profile"=>"nullable|mimes:jpg,png|file|min:0|max:5000"
        ]);
        $user=User::find(auth()->user()->id);
    $user->name=$request->name;

        if($request->hasFile("profile")){

            $profile=$request->profile;

            $newName=uniqid()."_profile_.".$profile->extension();

            $profile->storeAs("public/user_profile/",$newName);

            $user->profile=$newName;
        }

        $user->update();

        return redirect()->back();



    }
}
