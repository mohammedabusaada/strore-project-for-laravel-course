<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;


// Admin Routes

Route::resource('products', ProductController::class);

Route::resource('categories', CategoryController::class);

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


Route::get('/auth/login', function () {
    return view('auth.login');
});


Route::get('/auth/register', function () {
    return view('auth.register');
});


// Front Routes

Route::get('/', [FrontController::class, 'index'])->name('home-front');

//

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
