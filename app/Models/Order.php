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
        return $this->belongsTo(Product::class,"product_id")->select("name","id");
    }
}
