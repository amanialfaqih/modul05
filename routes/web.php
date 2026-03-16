<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Models\Book;

Route::get('/', function () {

    $books = Book::latest()->take(8)->get();

    return view('frontend.home', compact('books'));

});

Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class);