<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductsAttribute;
use App\Models\ProductsImage;
use App\Models\Section;
use Illuminate\Auth\Access\Gate;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Contracts\Auth\Access\Gate as AccessGate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Illuminate\Support\Facades\Storage;
use Image;

class ProductController extends Controller
{
    public function products(){

        $products=Product::where("admin_id",auth()->guard('admin')->user()->id)->get();
        return view("admin.catalogue.products",compact("products"));
    }

    public function addProducts(Request $request){

        if($request->isMethod("POST")){

            
            $request->validate([
                "name"=>"required|min:4|max:100",
                "category_id"=>"required|exists:categories,id",
                "brand_id"=>"required|exists:brands,id",
                "price"=>"required|numeric",
                "shipping_fee"=>"nullable|numeric",
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
            if(Auth::guard("admin")->user()->type=='Vendor'){
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
            $product->shipping_fee=$request->shipping_fee;
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

    public function productStatus(Request $request){

        $product=Product::find($request->product_id);

        if( $this->authorize("update",$product)){
        
        }else{
            abort(403);
        }
 

        if($request->status=="active"){
            $product->status=0;
        }
        else{
            $product->status=1;
        }

        $product->update();

        return response($product->status);
    }

    public function update(Request $request,$id=null){

        $product=Product::find($id);

        
       if( $this->authorize("update",$product)){
        
       }else{
           abort(403);
       }

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

            if( $this->authorize("deleteProduct",$product)){
        
            }else{
                abort(403);
            }
     


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

            $pproduct=Product::find($request->product_id);

            if( $this->authorize("addAttributes",$pproduct)){
        
            }else{
                abort(403);
            }

            $request->validate([
                "sizes.*"=>"required|max:10",
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
        $product= $attribute->getProduct;

        if( $this->authorize("status",$product)){
        
        }else{
            abort(403);
        }
 

        
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
            $product=$attribute->getProduct;

            if( $this->authorize("updateAttribute",$product)){
        
            }else{
                abort(403);
            }
     

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


     
     ///////Images


     public function addImages(Request $request,$id=null){
        
        $product=Product::select("id","price","name","admin_id","color","image","code")->with("images")->find($id);

        if( $this->authorize("addImages",$product)){
        
        }else{
            abort(403);
        }
 
        if($request->isMethod("POST")){

            $request->validate([
                "images"=>"required",
                "images.*"=>"file|mimes:jpg,png|max:5000"
            ]);

            $id=$request->product_id;
            if($request->hasFile("images")){
                $files=$request->file("images");

             


                foreach ($files as $key => $file) {
                    
                    $newName=uniqid()."_product_image_.".$file->extension();
                    
                    Image::make($file)->resize(255,255)->save("storage/frontend/products/small/".$newName);
                    Image::make($file)->resize(500,500)->save("storage/frontend/products/medium/".$newName);
                    Image::make($file)->resize(1000,1000)->save("storage/frontend/products/large/".$newName);


                    $productimages=new ProductsImage();
                    $productimages->product_id=$id;
                    $productimages->status=1;
                    $productimages->name=$newName;
                    $productimages->save();
                }

                return redirect()->back()->with("success_message","Product Images Added Successfully");

            }


        }

        return view("admin.catalogue.add_images",compact("product"));
     }


     public function imageStatus(Request $request){

        $image=ProductsImage::find($request->image_id);
        $product=$image->getProduct;

        if( $this->authorize("imageStatus",$product)){
        
        }else{
            abort(403);
        }
 

        if($request->status=="active"){
            $image->status=0;
        }
        else{
            $image->status=1;
        }

        $image->update();

        return response($image->status);
    

     }

     public function imageDelete(Request $request){

        $request->validate([
            "imageid"=>"required|exists:products_images,id",
        ]);

        //get Image;

        $id=$request->imageid;
        $image=ProductsImage::find($id);

        //

        //Get Product

        $product=$image->getProduct;

        //

        if( $this->authorize("imageDelete",$product)){
        
        }else{
            abort(403);
        }
 
        


            Storage::delete("public/frontend/products/small/".$image->name);
            Storage::delete("public/frontend/products/medium/".$image->name);
            Storage::delete("public/frontend/products/large/".$image->name);

        

        $image->delete();
        
        return redirect()->back()->with("delete_message","Product Images Deleted Successfully");

     }

}
