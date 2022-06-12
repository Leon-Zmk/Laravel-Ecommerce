<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;

class Category extends Model
{
    use HasFactory;

    public function sections(){
       return $this->belongsTo(Section::class,"section_id")->select("id","name");
    }

    public function parents(){
       return $this->belongsTo(Category::class,"parent_id")->select("id","name");
    }

    public function subcategories(){
       return $this->hasMany(Category::class,"parent_id");
    }
}
