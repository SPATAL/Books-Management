<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;

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


Auth::routes();


Route::prefix('admin')->middleware('admin')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Book Management

    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::get('/books/{slug}', [BookController::class, 'show'])->name('books.show');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{slug}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{slug}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{slug}', [BookController::class, 'destroy'])->name('books.destroy');

    // Author Management
    Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('/authors/create', [AuthorController::class, 'create'])->name('authors.create');
    Route::get('/authors/{slug}', [AuthorController::class, 'show'])->name('authors.show');
    Route::post('/authors', [AuthorController::class, 'store'])->name('authors.store');
    Route::get('/authors/{slug}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
    Route::put('/authors/{slug}', [AuthorController::class, 'update'])->name('authors.update');
    Route::delete('/authors/{slug}', [AuthorController::class, 'destroy'])->name('authors.destroy');

    //Route::resource('authors', AuthorController::class);
    
    // User Management
    Route::resource('users', UserListController::class)->except(['create', 'store']);

    
});

Route::get('/user', [App\Http\Controllers\HomeController::class, 'user'])->name('user');



// Route::resource('admin', BookController::class);

// Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin')->middleware('admin');

// Route::get('/user', [App\Http\Controllers\HomeController::class, 'user'])->name('user');
