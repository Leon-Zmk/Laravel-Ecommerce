<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;


    public static function getsections(){
        return Section::all();
    }

    public function categories(){
        return $this->hasMany(Category::class,"section_id")->where("parent_id",0)->with("subcategories");
    }
}
