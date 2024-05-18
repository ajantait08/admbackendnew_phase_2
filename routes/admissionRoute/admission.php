<?php

//echo 'entered here routes'; exit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admission\AdmissionController;
use App\Models\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admission\ApplicantHomeController;

Route::get('/products',[ProductController::class,'index']);

Route::post('/create_products',function(){

});

Route::post('/register',[AuthController::class,'register']);

Route::controller(AdmissionController::class)->group(function(){
    Route::post('register_user','register_user');
    Route::post('verify_email','verify_email');
    Route::post('user_login','user_login');
});

Route::group(['middleware' => ['auth:sanctum']],function(){
    Route::controller(ApplicantHomeController::class)->group(function(){
        Route::post('getAppHomeDetails','getAppHomeDetails');
    });
    });

    // Route::group(['middleware' => ['auth:sanctum']], function() {
    //     Route::controller(FeeController::class)->group(function () {
    //         Route::post('submitComplain','submitComplain');
    //         Route::post('tractComplainList','tractComplainList');
    //         Route::post('getComplainDetails','getComplainDetails');
    //         Route::post('logout','logout');
    //     });
    // });

?>