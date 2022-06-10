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

        Route::get("/update-vendor-details/{detail_type}",[App\Http\Controllers\AdminControllers\AdminController::class,"updateVendorDetails"])->name("vupdate");
        Route::post("/update-vendor-details/{detail_type}",[App\Http\Controllers\AdminControllers\AdminController::class,"updateVendorDetails"])->name("vupdate");

        Route::get("/management/{type?}",[App\Http\Controllers\AdminControllers\AdminController::class,"admins"])->name("management");
        Route::post("/management/status",[App\Http\Controllers\AdminControllers\AdminController::class,"status"])->name("manageStatus");
        Route::get("/management/{id?}/detail",[App\Http\Controllers\AdminControllers\AdminController::class,"detail"])->name("managementDetail");


        //catalogue 

        Route::get("/management/catalogue/sections",[App\Http\Controllers\AdminControllers\SectionController::class,"sections"])->name("sectionsManagement");
        Route::post("management/catalogue/add_update/sections/{id?}",[App\Http\Controllers\AdminControllers\SectionController::class,"addUpdateSections"])->name("ausections");
        Route::get("management/catalogue/add_update/sections/{id?}",[App\Http\Controllers\AdminControllers\SectionController::class,"addUpdateSections"])->name("ausections");
        Route::post("management/catalogue/delete/sections/{id?}",[App\Http\Controllers\AdminControllers\SectionController::class,"delete"])->name("sectionDelete");

        
        //catalogue

    });
   
    Route::get("/login",[App\Http\Controllers\AdminControllers\AdminController::class,"login"])->name("dlogin");
    Route::post("/login",[App\Http\Controllers\AdminControllers\AdminController::class,"login"])->name("dlogin");
    Route::get("/logout",[App\Http\Controllers\AdminControllers\AdminController::class,"logout"])->name("dlogout");



 
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
