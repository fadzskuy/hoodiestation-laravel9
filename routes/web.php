<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');

Route::group(['middleware' => ['auth:user']], function() {
    Route::get('/shop/show/{id}', [ShopController::class, 'show']);
    Route::get('/shop/detail/{id}', [ShopController::class, 'detail']);
    Route::get('/shop/category/{id}', [ShopController::class, 'category']);
    Route::get('/delete/{id}', [CartController::class, 'delete']);
    Route::post('/cart/store', [CartController::class, 'store']);
    Route::get('/shop', [ShopController::class, 'index'])->name('search');
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::get('/cart', [CartController::class, 'index']);     
    Route::put('/cart/plus/{cart:id}', [CartController::class, 'tambah'])->name('tambah'); 
    Route::put('/cart/min/{cart:id}', [CartController::class, 'kurang'])->name('kurang'); 
    //MIDTRANS PAYMENT GATEWAY
    Route::get('/invoice/{id}', [OrderController::class, 'invoice']);
    Route::post('/checkout/store', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/checkout', [OrderController::class, 'index']);
    Route::post('/cancel', [OrderController::class, 'cancel'])->name('cancel');
    Route::post('/invoice/cancel/{id}', [OrderController::class, 'batal'])->name('batal');
});

Route::group(['middleware' => ['auth:admin']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/produk', [ProdukController::class, 'index'])->name('cari');
    Route::get('/produk/category/{id}', [ProdukController::class, 'category']);
    Route::get('/history', [HistoryController::class, 'index']);
    //CRUD admin
    Route::delete('/produk/{product}', [ProdukController::class, 'destroy']);
    Route::post('/create/posts', [CreateController::class, 'create']);
    Route::resource('/create', CreateController::class);
    Route::get('/edit/{product:id}', [ProdukController::class, 'edit'])->name('edit');
    Route::put('/update/{product:id}', [ProdukController::class, 'update'])->name('update');
    Route::get('/historypdf', [HistoryController::class, 'historypdf'])->name('historypdf');
});