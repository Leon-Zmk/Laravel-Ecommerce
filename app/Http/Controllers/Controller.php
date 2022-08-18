<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function authorize($ability, $arguments=[])
    {   
        if(auth()->guard('admin')->check()){
           
            return auth()->guard("admin")->user()->id == $arguments->admin_id;
        }

        return false;

    }


}
