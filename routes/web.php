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



// Front Routes

Route::get('/', [FrontController::class, 'index'])->name('home');
