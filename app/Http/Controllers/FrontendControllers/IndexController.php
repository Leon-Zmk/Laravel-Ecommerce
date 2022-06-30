<?php

namespace App\Http\Controllers\FrontendControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class IndexController extends Controller
{

    public function index(){
        return view("frontend.index");
    }

}
