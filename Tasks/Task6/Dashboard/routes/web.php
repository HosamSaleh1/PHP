<?php

// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\modules\MainController;
use App\Http\Controllers\modules\products\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});
// -- invokable => controller has one method (invokable) 
Route::group(['prefix'=>'dashboard','middleware'=>'verified'],function(){
    Route::get('/',MainController::class)->name('main'); // => url = local/dashboard

    Route::group(['prefix'=>'products','as'=>'products.'],function(){
        Route::get('/',[ProductController::class,'index'])->name('index'); // url = local/dashboard/products/
        Route::get('create',[ProductController::class,'create'])->middleware('password.confirm')->name('create'); // url = local/dashboard/products/create
        Route::get('edit/{id}',[ProductController::class,'edit'])->name('edit');
        Route::post('store',[ProductController::class,'store'])->name('store');
        Route::PUT('update/{id}',[ProductController::class,'update'])->name('update'); // => post (PUT-PATCH-DELETE) 
        Route::delete('destroy/{id}',[ProductController::class,'destroy'])->name('destroy');
        Route::patch('change-status/{id}',[ProductController::class,'changeStatus'])->name('change.status');
    });
});

Auth::routes(['verify' => true,'register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
