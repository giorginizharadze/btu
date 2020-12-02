<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\PageController;

Route::name('front.')->group(function () {
  Route::get('/', [PageController::class, 'index']);
});

Route::name('admin.')->prefix('admin')->middleware('custom_auth')->group(function () {
  Route::get('/', [AdminController::class, 'index'])->name('home');
  Route::resource('/post', PostController::class);
  Route::resource('/category', CategoryController::class);
});

Route::prefix('custom')
  ->name('custom.')
  ->group(function () {
    Route::post('/login', [AuthController::class, 'customLogin'])->name('login')->middleware('custom_guest');
    Route::post('/register', [AuthController::class, 'customRegister'])->name('register')->middleware('custom_guest');
    Route::post('/logout', [AuthController::class, 'customLogout'])->name('logout')->middleware('custom_auth');
  });

Auth::routes();
