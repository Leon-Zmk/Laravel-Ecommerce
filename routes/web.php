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



Route::get("/vendor/register",[App\Http\Controllers\AdminControllers\AdminController::class,"Register"])->name("vregister");
Route::post("/vendor/register",[App\Http\Controllers\AdminControllers\AdminController::class,"Register"])->name("vregister");


Route::prefix("/admin")->group(function(){

    Route::middleware("admin")->group(function(){
        
        Route::get("/dashboard",[App\Http\Controllers\AdminControllers\AdminController::class,"dashboard"])->name("dashboard");
        Route::get("/update-admin-password",[App\Http\Controllers\AdminControllers\AdminController::class,"updatePassword"])->name("apupdate");
        Route::post("/update-admin-password",[App\Http\Controllers\AdminControllers\AdminController::class,"updatePassword"])->name("apupdate");
        Route::post("/check-current-password",[App\Http\Controllers\AdminControllers\AdminController::class,"checkCurrentPassword"])->name("ccpassword");

        Route::get("/update-admin-details",[App\Http\Controllers\AdminControllers\AdminController::class,"updateDetails"])->name("adupdate");
        Route::post("/update-admin-details",[App\Http\Controllers\AdminControllers\AdminController::class,"updateDetails"])->name("adupdate");

        Route::get("/register-shop",[App\Http\Controllers\AdminControllers\AdminController::class,"registerShop"])->name("registershop");
        Route::post("/register-shop",[App\Http\Controllers\AdminControllers\AdminController::class,"registerShop"])->name("registershop");

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


Route::middleware("auth")->group(function(){

    Route::post("/add-cart",[App\Http\Controllers\FrontendControllers\OrderController::class,"saveOrder"])->name("saveorder");
    Route::get("cart",[App\Http\Controllers\FrontendControllers\OrderController::class,"Cart"])->name("cart");
    Route::post("updateCart/",[App\Http\Controllers\FrontendControllers\OrderController::class,"updateCart"])->name("updatecart");

    Route::get("user/profile",[App\Http\Controllers\UserController::class,"Profile"])->name("profile");
    Route::post("user/update-info",[App\Http\Controllers\UserController::class,"updateInfo"])->name("updateinfo");
});



Route::get("/",[App\Http\Controllers\FrontendControllers\IndexController::class,"index"])->name("index");
Route::get("/item/detail/{id?}",[App\Http\Controllers\FrontendControllers\IndexController::class,"itemDetail"])->name("itemdetail");
Route::get("shoping/",[App\Http\Controllers\FrontendControllers\IndexController::class,"shop"])->name("shop");
Route::get("/specific/{category?}",[App\Http\Controllers\FrontendControllers\IndexController::class,"specific"])->name("specific");
Route::post("/specific/{category?}",[App\Http\Controllers\FrontendControllers\IndexController::class,"specific"])->name("specific");
Route::post("/gsq",[App\Http\Controllers\FrontendControllers\IndexController::class,"getSizeQuantity"])->name("getsizequantity");

Route::get("/vendors",[App\Http\Controllers\FrontendControllers\IndexController::class,"vendors"])->name("vendors");
Route::get("/vendor/detail/{id?}",[App\Http\Controllers\FrontendControllers\IndexController::class,"vendorDetail"])->name("vendordetail");






Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
