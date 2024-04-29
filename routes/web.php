<?php

use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\BillingQuotaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WorkSpaceController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect('/workspace');
    });

    Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

    //workspace
    Route::resource('workspace', WorkSpaceController::class);
    
    //API TOKEN
    Route::get('/workspace/{workspace}/api_token/create', 
    [ApiTokenController::class, 'create'])->name('api_token.create');

    Route::post('/workspace/{workspace}/api_token/create', 
    [ApiTokenController::class, 'store'])->name('api_token.store');

    Route::get('/api_token/{api_token}', 
    [ApiTokenController::class, 'show'])->name('api_token.show');

    Route::put('/api_token/{api_token}', 
    [ApiTokenController::class, 'update'])->name('api_token.update');

    //Quota
    Route::get('/workspace/{workspace}/quota/create', 
    [BillingQuotaController::class, 'create'])->name('billing_quota.create');

    Route::post('/workspace/{workspace}/quota/create', 
    [BillingQuotaController::class, 'store'])->name('billing_quota.store');

    Route::delete('/quota/{id}', 
    [BillingQuotaController::class, 'destroy'])->name('billing_quota.destroy');
});

Route::middleware('guest')->group(function () {

    Route::get('/', function () {
       
        return redirect('/login');
    });

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');   
    
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');    
});


