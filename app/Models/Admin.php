<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guard="admin";

    public function personal(){
        return $this->belongsTo(Vendor::class,"vendor_id");
    }
    public function business(){
        return $this->belongsTo(Vshop::class,"vendor_id");
    }
   
}
