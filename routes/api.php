<?php

//echo 'entered here test !'; exit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

});

Route::get('/a', function () {

    return 'Hi';
});

Route::group(['middleware' => ['auth:sanctum']], function() {
    //
    Route::controller(UserController::class)->group(function () {
        Route::get('getDetails', 'getDetails');
    });
});

Route::controller(UserController::class)->group(function () {
    Route::get('getDetails', 'getDetails');
    Route::post('loginApi','loginApi');
});

// HERE ADD ROUTES MODULE WISE

include('admissionRoute/admission.php');