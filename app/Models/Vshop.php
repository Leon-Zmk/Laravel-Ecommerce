<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vshop extends Model
{
    use HasFactory;

    public function owner(){
        return $this->belongsTo(Vendor::class,"shop_owner");
    }
}
