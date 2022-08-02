<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function Categories(){
        $categories=Category::all();
        return view("admin.catalogue.categories",compact("categories"));
    }

    public function addCategories(Request $request){
        if($request->isMethod("post")){

            $request->validate([
                "name"=>"required|max:20",
                "category_id"=>"required",
                "section_id"=>"required|exists:sections,id",
                "description"=>"nullable",
                "url"=>"required",
                "image"=>"nullable|mimes:jpg,png|file|max:5000"
            ]);

            $category=new Category();
            $category->name=$request->name;
            $category->parent_id=$request->category_id;
            $category->section_id=$request->section_id;
            $category->description=$request->description;
            $category->url=$request->url;

            if($request->hasFile("image")){
              

                    $request->validate([
                        "image"=>"file|min:0|max:5000",
                    ]);
    
                    $img=$request->file("image");
    
                    $newName=uniqid()."profile_photo.".$img->extension();
                    
                    Image::make($img)->save("storage/categories_images/normal/$newName");
                    Image::make($img)->resize(100,100)->save("storage/categories_images/resize/$newName");

                    
    
                    $category->image=$newName;
    
                
            }else{
                $category->image="";
            }

            $category->save();
            return redirect()->back()->with("success_message","Category Added Successfully");

        }else{

            $sections=Section::all();
            return view("admin.catalogue.add_categories",compact("sections"));
        }
    }

    public function getCategories(Request $request){

        $getcategories=Category::with("subcategories")->where(["parent_id"=>"0","section_id"=>"$request->section_id"])->get();
        return  view("admin.catalogue.append_category",compact("getcategories"));
    }


    public function update(Request $request,$id=null){
       if($request->isMethod("post")){

                $request->validate([
                    "name"=>"required|max:20",
                    "category_id"=>"required",
                    "section_id"=>"required|exists:sections,id",
                    "description"=>"nullable",
                    "url"=>"required",
                    "image"=>"nullable|mimes:jpg,png|file|max:5000"
                ]);

                $category=Category::find($request->id);
                $category->name=$request->name;
                $category->parent_id=$request->category_id;
                $category->section_id=$request->section_id;
                $category->description=$request->description;
                $category->url=$request->url;

                if($request->hasFile("image")){
              

                    $request->validate([
                        "image"=>"file|min:0|max:5000",
                    ]);
    
                    $img=$request->file("image");
    
                    $newName=uniqid()."profile_photo.".$img->extension();
    
                    Image::make($img)->save("storage/categories_images/normal/$newName");
                    Image::make($img)->resize(100,100)->save("storage/categories_images/resize/$newName");
    
                    $category->image=$newName;
    
                
            }

            $category->update();

            return redirect()->route("categoriesManagement")->with("success_message","Category Updated Successfully");

       }

       if(!empty($id)){

        
        $category=Category::find($id);
        $sections=Section::all();
        $getcategories=Category::with("subcategories")->where(["parent_id"=>"0","section_id"=>"$category->section_id"])->get();

        return view("admin.catalogue.update_category",compact("category","sections","getcategories"));

            }else{
                return "There is No Such Category";
            }
    }

    public function delete(Request $request){

        $id=$request->category_id;

        if($id){
            $category=Category::find($id);

            if(!empty($category->image)){
                Storage::delete("public/categories_images/".$category->image);
            }

            $category->delete();

        }else{
            return "There is such Category";
        }

        return redirect()->back()->with("delete_message","Category Deleted Successfully");


    }

    public function deleteImage(Request $request){
        $id=$request->category_id;

        $category=Category::find($id);
        Storage::delete("public/categories_images/".$category->image);

        $category->image="";
        $category->update();

        return redirect()->back();
    }
}
