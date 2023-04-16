<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth2\LoginController;
use App\Http\Controllers\Auth2\RegisterController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/', function (){
//    return redirect()->route('admin.clientOrBusiness');
//});

Route::middleware('auth')->group(function () {

    Route::group(['middleware' => ['role:client']], function () {
        Route::get('/client/cabinet', [ClientController::class, 'index'])->name('client.index');
    });

    Route::group(['middleware' => ['role:business']], function () {
        Route::get('/business/cabinet', [BusinessController::class, 'index'])->name('business.index');

        Route::post('/business/payment/genIframe/callback', [BusinessController::class, 'callback'])->name('business.callback');
    });

    Route::group(['middleware' => ['role:super-user']], function () {
        Route::get('/admin/userList', [AdminController::class, 'userList'])->name('admin.user_list');
        Route::get('/admin/createClient', [AdminController::class, 'createClient'])->name('admin.create_client');
        Route::post('/register/client', [RegisterController::class, 'registerClient'])->name('admin.register_client');
        Route::get('/admin/createBusiness', [AdminController::class, 'createBusiness'])->name('admin.create_business');
        Route::post('/register/business', [RegisterController::class, 'registerBusiness'])->name('admin.register_business');
    });

    Route::get('/', [AdminController::class, 'clientOrBusiness'])->name('admin.clientOrBusiness');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


Route::get('/register', [RegisterController::class, 'create'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'create'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('client/login', [ClientController::class, 'createClient'])->name('client.login.form');
Route::post('client/login', [ClientController::class, 'loginClient'])->name('client.login');
//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
