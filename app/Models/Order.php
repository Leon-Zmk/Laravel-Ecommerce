<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    public function getAttri(){
        return $this->belongsTo(ProductsAttribute::class,"product_attribute_id");
    }

    public function getProduct(){
        return $this->belongsTo(Product::class,"product_id")->select("name","id","shipping_fee");
    }

    public static function getPrice(){
        
        $totalprice=Order::where("order_member_id",auth()->user()->id)->get()->sum("item_total_fee");
     
        
       return $totalprice;
    }


  public function getBuyers(){

    return $this->belongsTo(Buyer::class,"order_member_id");
  }
}
