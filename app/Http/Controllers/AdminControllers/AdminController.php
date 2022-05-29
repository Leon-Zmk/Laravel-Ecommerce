<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image as FacadesImage;
use Image;

class AdminController extends Controller
{
    public function dashboard(){
        return view("admin.dashboard");
    }
    public function login(Request $request){

        if($request->isMethod("POST")){
            $data=$request->all();
           

            if(Auth::guard("admin")->attempt(["email"=>$data['email'],"password"=>$data['password']])){

                return redirect()->route("dashboard");
            }else{
                return redirect()->back()->with("status","email or password is incorrect please try again");
            }
        
        }
        return view("admin.login");
    }

    public function checkCurrentPassword(Request $request){

        $current_password=$request->current_password;
        if(Hash::check($current_password,Auth::guard("admin")->user()->password)){
            return "true";
        }else{
            return "false";
        }    
        
        
        
    }

    public function updatePassword(Request $request){

        if($request->isMethod("POST")){

            if(!Hash::check($request->current_password,Auth::guard("admin")->user()->password)){
                return redirect()->back()->with("error_message","Your current password is incorrect");
            }
            $request->validate([
             "new_password"=>"required",
             "confirm_password"=>"required|same:new_password",
            ]);

            $user=Admin::find(Auth::guard("admin")->user()->id);
            $user->password=Hash::make($request->new_password);
            $user->update();

            return redirect()->back()->with("success_message","Password updated successfully");

        };
        return view("admin.setting.admin_update_password");
    }

    public function updateDetails(Request $request){

        if($request->isMethod("POST")){

            $request->validate([
                "name"=>"nullable|regex:/^[a-zA-Z]+$/u|min:2|max:20",
                "mobile"=>"nullable|unique:admins,mobile|max:15"
        ]);

        if(!empty($request)){

           

            $user=Admin::find(Auth::guard("admin")->user()->id);
            if($request->name){
                $user->name=$request->name;
            }
            if($request->mobile){
                $user->mobile=$request->mobile;
            }

            if($request->hasFile("image")){
                $img=$request->file("image");

                $newName=uniqid()."profile_photo.".$img->extension();

                Image::make($img)->save("storage/user_profile/$newName");

                $user->image=$newName;

            }

            $user->update();

            return redirect()->back()->with("success_message","Details updated successfully");

        }

        };
        return view("admin.setting.admin_update_detail");
    }
}
