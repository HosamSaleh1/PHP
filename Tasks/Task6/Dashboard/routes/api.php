<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apis\ProductController;
use App\Http\Controllers\apis\auth\LoginController;
use App\Http\Controllers\apis\auth\ProfileController;
use App\Http\Controllers\apis\auth\PasswordController;
use App\Http\Controllers\apis\auth\RegisterController;
use App\Http\Controllers\apis\auth\EmailVerificationController;
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


Route::group(['middleware'=>'VerifyApiPassword'],function(){
    // guest
    Route::group(['prefix'=>'admins'],function(){
        Route::post('register',RegisterController::class);
        Route::post('login',[LoginController::class,'login']);
        Route::post('verify-email',[PasswordController::class,'verifyEmail']);
    });
    // verified
    Route::group(['middleware'=>['auth:sanctum','ApiVerifiedMail']],function(){
        Route::group(['prefix'=>'admins'],function(){
            Route::get('logout',[LoginController::class,'logout']);
            Route::get('logout-all-devices',[LoginController::class,'logoutAllDevices']);
            Route::get('profile',ProfileController::class);
            Route::post('set-new-password',[PasswordController::class,'setNewPassword']);
        });
        Route::group(['prefix'=>'products'],function(){
            Route::get('/',[ProductController::class,'index']);
            Route::get('/create',[ProductController::class,'create']);
            Route::get('/edit/{id}',[ProductController::class,'edit']);
            Route::post('store',[ProductController::class,'store']);
            Route::put('update/{id}',[ProductController::class,'update']);
            Route::delete('destroy/{id}',[ProductController::class,'destroy']);
        });
    });
    // authenticated 
    Route::group(['middleware'=>'auth:sanctum'],function(){
        Route::group(['prefix'=>'admins'],function(){
            Route::get('send-code',[EmailVerificationController::class,'sendCode']);
            Route::get('email-verification',[EmailVerificationController::class,'emailVerification']);
        });
    });
});
// guest
// authenticated
// verified 