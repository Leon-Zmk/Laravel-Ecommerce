<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\Vshop;
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
           

            if(Auth::guard("admin")->attempt(["email"=>$data['email'],"password"=>$data['password']]) && Auth::guard("admin")->user()->status==1){

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

                $request->validate([
                    "image"=>"file|min:0|max:5000",
                ]);

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



    //////////////



    public function updateVendorDetails(Request $request,$detail_type){


        if($request->isMethod("post")){
            if($detail_type=="password"){
                if(!Hash::check($request->current_password,Auth::guard("admin")->user()->password)){
                    return redirect()->back()->with("error_message","Your current password is incorrect");
                }

                $request->validate([
                    "new_password"=>"required",
                    "confirm_password"=>"required|same:new_password"
                ]);

                $user= Admin::find(Auth::guard("admin")->user()->id);
                $user->password=Hash::make($request->new_password);
                $user->update();
                return redirect()->back()->with("success_message","Password Updated Successfully");
            }
            elseif($detail_type=="personal"){

                $user=Vendor::find(Auth::guard("admin")->user()->vendor_id);

                $request->validate([
                    "name"=>"required|regex:/^[a-zA-Z]+$/u|min:2|max:15",
                    "city"=>"required",
                    "phone"=>"required|unique:vendors,phone,$user->id|max:15",
                    "address"=>"required",
                ]);

                $user=Vendor::find(Auth::guard("admin")->user()->vendor_id);
                $user->name=$request->name;
                $user->city=$request->city;
                $user->phone=$request->phone;
                $user->address=$request->address;
                $user->update();

                return redirect()->back()->with("success_message","Info Updated Successfully");
            }
            elseif($detail_type=="business"){
                $request->validate([
                    "shop_name"=>"required|max:20",
                    "shop_address"=>"required",
                    "shop_website"=>"nullable",
                    "shop_mobile"=>"required",
                    "shop_profile"=>"nullable|file|min:0|max:5000",
                    "shop_background_profile"=>"nullable|file|min:0|max:5000",
                    "shop_image_verification"=>"nullable|file|min:0|max:5000",
                ]);

                $shop=Vshop::find(Auth::guard("admin")->user()->vendor_id);
                $shop->shop_name=$request->shop_name;
                $shop->shop_address=$request->shop_address;
                $shop->shop_website=$request->shop_website;
                $shop->shop_mobile=$request->shop_mobile;

                if($request->hasFile("shop_image_verification")){
                    $img=$request->file("shop_image_verification");
                    $newName=uniqid().Auth::guard("admin")->user()->id."verification_image.".$img->extension();

                    Image::make($img)->save("storage/verification_images/$newName");

                    $shop->shop_image_verification=$newName;

                }
               
                $shop->update();

                return redirect()->back()->with("success_message","Shop details updated Successfully");
            }
            else{

            }
        }

        return view("vendors.update_vendor_detail",compact("detail_type"));
    }






    ///////////////

    public function logout(){
         Auth::guard("admin")->logout();
         return redirect()->route("dlogin");
    }
}
