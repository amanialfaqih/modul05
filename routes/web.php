<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Models\Book;
use App\Http\Controllers\OrderController;

// =====================
// HALAMAN AWAL
// =====================
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// =====================
// AUTH
// =====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =====================
// HOME
// =====================
Route::get('/home', function () {
    $books = Book::latest()->take(8)->get();
    return view('frontend.home', compact('books'));
})->name('home')->middleware('auth');

// =====================
// 🔥 SEMUA HARUS LOGIN
// =====================
Route::middleware(['auth'])->group(function () {

    // =====================
    // 📚 ADMIN
    // =====================
    Route::get('/books/pdf', [BookController::class, 'exportPdf'])->name('books.pdf');
    Route::get('/books/excel', [BookController::class, 'exportExcel'])->name('books.excel');

    Route::resource('books', BookController::class);
    Route::resource('categories', CategoryController::class);

    // =====================
    // 🛍️ SHOP
    // =====================
    Route::get('/shop', [BookController::class, 'shop'])->name('shop');

    // =====================
    // 🛒 CART
    // =====================
    Route::get('/add-to-cart/{id}', [BookController::class, 'addToCart'])->name('add.to.cart');
    Route::get('/cart', [BookController::class, 'cart'])->name('cart');
    Route::get('/remove-cart/{id}', [BookController::class, 'removeCart'])->name('remove.cart');

    // =====================
    // 💳 CHECKOUT
    // =====================
    Route::get('/checkout', [BookController::class, 'checkout'])->name('checkout');

    // =====================
    // 🧾 INVOICE
    // =====================
    Route::get('/cart/invoice', [BookController::class, 'invoicePdf'])->name('cart.invoice');

    // =====================
    // ❤️ WISHLIST
    // =====================
    Route::get('/wishlist', [BookController::class, 'wishlist'])->name('wishlist');
    Route::get('/wishlist/add/{id}', [BookController::class, 'addWishlist'])->name('wishlist.add');
    Route::get('/wishlist/remove/{id}', [BookController::class, 'removeWishlist'])->name('wishlist.remove');

    // =====================
    // 📦 ORDERS
    // =====================
    Route::get('/orders', function () {
        return view('user.orders');
    })->name('orders');

    // =====================
    // ⚙️ SETTINGS (FIX)
    // =====================
    Route::get('/settings', [BookController::class, 'settings'])->name('settings');
    Route::post('/settings/update', [BookController::class, 'updateSettings'])->name('settings.update');

    // =====================
// ORDER
// =====================

// checkout user
Route::post('/checkout', [OrderController::class, 'checkout'])
    ->name('checkout');

// admin lihat order
Route::get('/orders', [OrderController::class, 'index'])
    ->name('orders.index');

// approve admin
Route::get('/orders/approve/{id}', [OrderController::class, 'approve'])
    ->name('orders.approve');

});