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


        Route::get("/management/catalogue/categories",[App\Http\Controllers\AdminControllers\CategoryController::class,"Categories"])->name("categoriesManagement");
        Route::get("management/catalogue/add/categories",[App\Http\Controllers\AdminControllers\CategoryController::class,"addCategories"])->name("addCategories");
        Route::post("management/catalogue/add/categories",[App\Http\Controllers\AdminControllers\CategoryController::class,"addCategories"])->name("addCategories");
        Route::get("management/catalogue/get-ajax-categories",[App\Http\Controllers\AdminControllers\CategoryController::class,"getCategories"])->name("getCategories");
        Route::post("management/catalogue/delete/categories",[App\Http\Controllers\AdminControllers\CategoryController::class,"delete"])->name("categoryDelete");
        Route::get("/management/catalogue/update/categories/{id?}",[App\Http\Controllers\AdminControllers\CategoryController::class,"update"])->name("categoryUpdate");
        Route::post("/management/catalogue/update/categories/{id?}",[App\Http\Controllers\AdminControllers\CategoryController::class,"update"])->name("categoryUpdate");
        Route::post("/management/catalogue/delete-image/categories/",[App\Http\Controllers\AdminControllers\CategoryController::class,"deleteImage"])->name("deletecategoryImage");


        Route::get("/management/catalogue/brands",[App\Http\Controllers\AdminControllers\BrandController::class,"brands"])->name("brandsManagement");
        Route::post("management/catalogue/add_update/brands/{id?}",[App\Http\Controllers\AdminControllers\BrandController::class,"addUpdateBrands"])->name("auBrands");
        Route::get("management/catalogue/add_update/brands/{id?}",[App\Http\Controllers\AdminControllers\BrandController::class,"addUpdateBrands"])->name("auBrands");
        Route::post("management/catalogue/delete/brands/{id?}",[App\Http\Controllers\AdminControllers\BrandController::class,"delete"])->name("brandDelete");


        Route::get("/management/catalogue/products",[App\Http\Controllers\AdminControllers\ProductController::class,"products"])->name("productsManagement");
        Route::get("management/catalogue/add/products",[App\Http\Controllers\AdminControllers\ProductController::class,"addproducts"])->name("addproducts");
        Route::post("management/catalogue/add/products",[App\Http\Controllers\AdminControllers\ProductController::class,"addproducts"])->name("addproducts");
        Route::post("management/catalogue/delete/products/{id?}",[App\Http\Controllers\AdminControllers\ProductController::class,"deleteProduct"])->name("productDelete");
        Route::get("/management/catalogue/update/products/{id?}",[App\Http\Controllers\AdminControllers\ProductController::class,"update"])->name("productUpdate");
        Route::post("/management/catalogue/update/products/{id?}",[App\Http\Controllers\AdminControllers\ProductController::class,"update"])->name("productUpdate");
        Route::post("/management/product/status",[App\Http\Controllers\AdminControllers\ProductController::class,"productStatus"])->name("manageproductstatus");
        Route::post("/management/catalogue/delete-image/products/",[App\Http\Controllers\AdminControllers\ProductController::class,"deleteImage"])->name("deleteproductImage");

        
        Route::get("/management/catalogue/add/attributes/{id?}",[App\Http\Controllers\AdminControllers\ProductController::class,"addAttributes"])->name("attributes");
        Route::post("/management/catalogue/add/attributes/",[App\Http\Controllers\AdminControllers\ProductController::class,"addAttributes"])->name("addattributes");
        Route::post("/management/attributes/status",[App\Http\Controllers\AdminControllers\ProductController::class,"status"])->name("manageattributeStatus");
        Route::post("/management/catalogue/update/attributes/",[App\Http\Controllers\AdminControllers\ProductController::class,"updateAttribute"])->name("attributeUpdate");
        Route::post("/management/catalogue/delete/attributes/",[App\Http\Controllers\AdminControllers\ProductController::class,"deleteAttribute"])->name("attributeDelete");

        Route::get("/management/catalogue/add/images/{id?}",[App\Http\Controllers\AdminControllers\ProductController::class,"addImages"])->name("images");
        Route::post("/management/catalogue/add/images/",[App\Http\Controllers\AdminControllers\ProductController::class,"addImages"])->name("addimages");
        Route::post("/management/images/status",[App\Http\Controllers\AdminControllers\ProductController::class,"imageStatus"])->name("manageimageStatus");
        Route::post("/management/catalogue/delete/images/",[App\Http\Controllers\AdminControllers\ProductController::class,"imageDelete"])->name("imagedelete");


        


        // logout

        Route::get("/logout",[App\Http\Controllers\AdminControllers\AdminController::class,"logout"])->name("dlogout");


    });
   
    Route::get("/login",[App\Http\Controllers\AdminControllers\AdminController::class,"login"])->name("dlogin");
    Route::post("/login",[App\Http\Controllers\AdminControllers\AdminController::class,"login"])->name("dlogin");



 
});

Route::get("/",[App\Http\Controllers\FrontendControllers\IndexController::class,"index"])->name("index");




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
