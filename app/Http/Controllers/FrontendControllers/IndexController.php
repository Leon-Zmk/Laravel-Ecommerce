<?php

namespace App\Http\Controllers\FrontendControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Filter;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\Vshop;

class IndexController extends Controller
{

    public function index(){
        
        return view("frontend.index");
    }

    public function itemDetail(Request $request){

        $product=Product::find($request->id);
        $products=Product::where("section_id","$product->section_id")->orWhere("vendor_id","$product->vendor_id")->take(1)->get();
        
        return view("frontend.detail",compact("product","products"));

    }

    public function shop(){
        
        $products=Product::all();
        return view("frontend.shop",compact("products"));
    }


    public function specific($category){

       
        if(request()->ajax()){
            
            
            $products=Product::where("category_id","$category")->get();


            if(request()->brand){
                $products=Product::where("category_id","$category")->whereIn("brand_id",request()->brand)->get();

            }

            if(request()->color){
                $products=Product::where("category_id","$category")->whereIn("color",request()->color)->get();

            }

            if(request()->size){

                $filtersizeproducts=ProductsAttribute::where("size",request()->size)->select("product_id")->get();
                $products=Product::where("category_id","$category")->whereIn("id",$filtersizeproducts)->get();
                
            }
            
            

            return view("frontend.specific_ajax_products",compact("products","category"));
            
        }else{

            $category=$category;
            $products=Product::where("category_id","$category")->get();
            $brands_id=Product::where("category_id","$category")->get()->pluck("brand_id")->unique();
            $brands=Brand::whereIn("id",$brands_id)->select("id","name")->get();

            $colors=Product::where("category_id","$category")->get()->pluck("color")->unique();

            $sizes=Filter::where("base_filter_category","$category")->get();


        return view("frontend.specific_shop",compact("products","category","brands","colors","sizes"));
        }
    }


    public function vendors(){

        $vendors=Vshop::all();
    
        return view("frontend.vendors_page",compact("vendors"));
    }

    public function vendorDetail(Request $request){

        $vendor=Vshop::find($request->id);
        $products=Product::where("vendor_id","$request->id")->get();

        
        return view("frontend.vendor_detail",compact("vendor","products"));

    }

    

    public function getSizeQuantity(Request $request){

        $product=ProductsAttribute::where("product_id","$request->product_id")->where("id","=","$request->product_attribute_id")->select("stock")->first();
        $stock=$product->stock;
        return response($stock);
    }

}
