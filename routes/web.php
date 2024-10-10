<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\ImageController;

Route::resource('imagez', ImageController::class);

Auth::routes();


Route::prefix('admin')->middleware('admin')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Book Management
    Route::resource('books', BookController::class);
    
    // User Management
    Route::resource('users', UserListController::class)->except(['create', 'store']);

});

Route::get('/user', [App\Http\Controllers\HomeController::class, 'user'])->name('user');



// Route::resource('admin', BookController::class);

// Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin')->middleware('admin');

// Route::get('/user', [App\Http\Controllers\HomeController::class, 'user'])->name('user');
