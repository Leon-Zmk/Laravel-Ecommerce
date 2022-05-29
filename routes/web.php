<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix("/admin")->group(function(){

    Route::middleware("admin")->group(function(){
        Route::get("/dashboard",[App\Http\Controllers\AdminControllers\AdminController::class,"dashboard"])->name("dashboard");
        Route::get("/update-admin-password",[App\Http\Controllers\AdminControllers\AdminController::class,"updatePassword"])->name("apupdate");
        Route::post("/update-admin-password",[App\Http\Controllers\AdminControllers\AdminController::class,"updatePassword"])->name("apupdate");
        Route::post("/check-current-password",[App\Http\Controllers\AdminControllers\AdminController::class,"checkCurrentPassword"])->name("ccpassword");

        Route::get("/update-admin-details",[App\Http\Controllers\AdminControllers\AdminController::class,"updateDetails"])->name("adupdate");
        Route::post("/update-admin-details",[App\Http\Controllers\AdminControllers\AdminController::class,"updateDetails"])->name("adupdate");
    });
   
    Route::get("/login",[App\Http\Controllers\AdminControllers\AdminController::class,"login"])->name("dlogin");
    Route::post("/login",[App\Http\Controllers\AdminControllers\AdminController::class,"login"])->name("dlogin");


 
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
