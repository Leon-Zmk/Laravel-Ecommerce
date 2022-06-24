<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductsAttribute;
use App\Models\Section;
use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;

class ProductController extends Controller
{
    public function products(){

        $products=Product::all();
        return view("admin.catalogue.products",compact("products"));
    }

    public function addProducts(Request $request){

        if($request->isMethod("POST")){

            
            $request->validate([
                "name"=>"required|min:4|max:100",
                "category_id"=>"required|exists:categories,id",
                "brand_id"=>"required|exists:brands,id",
                "price"=>"required|numeric",
                "discount"=>"nullable|numeric",
                "description"=>"required|max:400",
                "code"=>"required|min:4|max:10",
                "color"=>"nullable",
                "image"=>"nullable|file|mimes:jpg,png|max:5000",
            ]);

            $findcategory=Category::find($request->category_id);
            $getsection=Section::find($findcategory->section_id);
            $product=new Product();
            
            
            
            $product->name=$request->name;
            if(Auth::guard("admin")->user()->type=='vendor'){
                $product->vendor_id=Auth::guard("admin")->user()->vendor_id;
            }else{
                $product->vendor_id=0;
            }

            $product->admin_id=Auth::guard('admin')->user()->id;
            $product->admin_type=Auth::guard('admin')->user()->type;
            $product->category_id=$request->category_id;
            $product->section_id=$getsection->id;
            $product->brand_id=$request->brand_id;
            $product->color=$request->color;
            $product->code=$request->code;
            $product->price=$request->price;
            $product->discount=$request->discount;
            $product->description=$request->description;

            if($request->hasFile("image")){

                $img=$request->file("image");
                $newName=uniqid()."_product_image_.".$img->extension();
                
                Image::make($img)->resize(255,255)->save("storage/frontend/products/small/".$newName);
                Image::make($img)->resize(500,500)->save("storage/frontend/products/medium/".$newName);
                Image::make($img)->resize(1000,1000)->save("storage/frontend/products/large/".$newName);


                $product->image=$newName;
            }

            $product->save();
            return redirect()->back()->with("success_message","Product Added Successfully");
            


        }else{

            $categories=Section::with("categories")->get();
            $brands=Brand::all();
            return view("admin.catalogue.add_products",compact("categories","brands"));
        }
    }

    public function update(Request $request,$id=null){

        if($request->isMethod("POST")){

            $request->validate([
                "name"=>"required|min:4|max:100",
                "category_id"=>"required|exists:categories,id",
                "brand_id"=>"required|exists:brands,id",
                "price"=>"required|numeric",
                "discount"=>"nullable|numeric",
                "description"=>"required|max:400",
                "code"=>"required|min:4|max:10",
                "color"=>"nullable",
                "image"=>"nullable|file|mimes:jpg,png|max:5000",
            ]);

            $findcategory=Category::find($request->category_id);
            $getsection=Section::find($findcategory->section_id);
            $product=Product::find($id);

            $product->name=$request->name;
            $product->category_id=$request->category_id;
            $product->section_id=$getsection->id;
            $product->brand_id=$request->brand_id;
            $product->color=$request->color;
            $product->code=$request->code;
            $product->price=$request->price;
            $product->discount=$request->discount;
            $product->description=$request->description;
            
            if($request->hasFile("image")){

                $img=$request->file("image");
                $newName=uniqid()."_product_image_.".$img->extension();
                
                Image::make($img)->resize(255,255)->save("storage/frontend/products/small/".$newName);
                Image::make($img)->resize(500,500)->save("storage/frontend/products/medium/".$newName);
                Image::make($img)->resize(1000,1000)->save("storage/frontend/products/large/".$newName);


                $product->image=$newName;
            }

            $product->update();
            return redirect()->back()->with("success_message","Product Updated Successfully");



        }else{

            $product=Product::find($id);
            $categories=Section::with("categories")->get();
            $brands=Brand::all();
            return view("admin.catalogue.update_product",compact("product","categories","brands"));

        }
    }


    public function deleteImage(Request $request){

        $id=$request->product_id;
        $product=Product::find($id);

        Storage::delete("public/frontend/products/small/".$product->image);
        Storage::delete("public/frontend/products/medium/".$product->image);
        Storage::delete("public/frontend/products/large/".$product->image);

        $product->image="product_default.png";
        $product->update();

        return redirect()->route("productsManagement")->with("success_message","Product Updated Successfully");
        
    }

    public function deleteProduct(Request $request,$id){
        
        if($id){
            $product=Product::find($request->id);

            if(!empty($product->image)){
                Storage::delete("public/frontend/products/small/".$product->image);
                Storage::delete("public/frontend/products/medium/".$product->image);
                Storage::delete("public/frontend/products/large/".$product->image);
            }

            $product->delete();
        }else{
            echo "There is no such product";
        }

        return redirect()->back()->with("delete_message","Product Delete Successfully");
    }

    public function addAttributes(Request $request,$id=null){
        
        $product=Product::select("id","price","name","color","image","code")->with("attributes")->find($id);

        if($request->isMethod("post")){

            $request->validate([
                "sizes.*"=>"required|unique:products_attributes,size|max:10",
                "skus.*"=>"required|unique:products_attributes,sku|max:10",
                "prices.*"=>"required|numeric",
                "stocks.*"=>"required|numeric"
            ]);

            $product_id=$request->product_id;
            $sku=$request->skus;

            foreach ($sku as $key => $value) {
                
                $attributes=new ProductsAttribute();
                $attributes->product_id=$product_id;
                $attributes->sku=$value;
                $attributes->size=$request->sizes[$key];
                $attributes->price=$request->prices[$key];
                $attributes->stock=$request->stocks[$key];
                
                $attributes->save();

                
            }
            return redirect()->back()->with("success_message","Attributes added successfully");

        }

        return view("admin.catalogue.add_attributes",compact("product"));

    }



    public function status(Request $request){

        $attribute=ProductsAttribute::find($request->attribute_id);
        if($request->status=="active"){
            $attribute->status=0;
        }
        else{
            $attribute->status=1;
        }

        $attribute->update();

        return response($attribute->status);
    

}

     public function updateAttribute(Request $request){

       
        
        $attributesid=$request->attributesid;

        foreach ($attributesid as $key => $value) {

            $request->validate([
                "uprices.*"=>"required|numeric",
                "ustocks.*"=>"required|numeric"
            ]);

            $attribute=ProductsAttribute::where("id","$value")->first();
            $attribute->price=$request->uprices[$key];
            $attribute->stock=$request->ustocks[$key];

            $attribute->update();
        }


        return redirect()->back()->with("success_message","Attribute Updated Successfully");

        

     }

     public function deleteAttribute(Request $request){
         $attributeid=$request->attributeid;
         $attribute=ProductsAttribute::find($attributeid);

         $attribute->delete();

         return redirect()->back()->with("delete_message","Attribute Deleted Successfully");
     }

}
