<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Controllers\Controller;


class BrandController extends Controller
{
    public function Brands(){
        $brands=Brand::all();
        return view("admin.catalogue.brands",compact("brands"));
    }

    public function addUpdateBrands(Request $request,$id=null){

        if(empty($id)){

            $request->validate([
                "name"=>"required|regex:/^[a-zA-Z]+$/u|max:50"
            ]);

            $brand=new Brand();
            $brand->name=$request->name;
            $brand->save();
            $message="Brand Add Successfully";
        }else{

            $brand=Brand::find($id);

           if($request->isMethod("post")){

                $request->validate([
                    "name"=>"required|regex:/^[a-zA-Z]+$/u|max:50"
                ]);

                $brand=Brand::find($id);
                $brand->name=$request->name;
                $brand->update();
                $message="Brand Updated Successfully";
           }else{
               return view("admin.catalogue.brand_update",compact("brand"));
           }
        }

        return redirect()->route("brandsManagement")->with("success_message",$message);

    }

    public function delete(Request $request,$id=null){
        if(!empty($id)){
            $brand=Brand::find($id);
            $brand->delete();
        }else{
            return "There is no brand";
        }

        return redirect()->back()->with("deleted_message","brand deleted successfully");
    }
}
