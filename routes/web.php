<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Models\Book;

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

// halaman pertama = login
Route::get('/', [AuthController::class, 'showLogin'])
    ->name('login')
    ->middleware('guest');

// proses login
Route::post('/login', [AuthController::class, 'login']);

// logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| SETELAH LOGIN (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // HOME (yang ada banner + books)
    Route::get('/home', function () {

        $books = Book::latest()->take(8)->get();

        return view('frontend.home', compact('books'));

    })->name('home');

    // CRUD BOOK
    Route::resource('books', BookController::class);

    // CRUD CATEGORY
    Route::resource('categories', CategoryController::class);

});