<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admission\AdmissionController;
use App\Models\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

Route::get('/products',[ProductController::class,'index']);

Route::post('/create_products',function(){

});

Route::post('/register',[AuthController::class,'register']);

Route::controller(AdmissionController::class)->group(function(){
    Route::post('register_user','register_user');
});

Route::group(['middleware' => ['auth:sanctum']],function(){

});

?>