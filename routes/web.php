<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;


// Halaman
Route::get('/', function () {
    return view('beranda');
});


// Route ke kategori
Route::get('products/{category}', [ProductsController::class, 'showByCategory'])->name('products.category');

// Route untuk menampilkan detail produk berdasarkan slug
Route::get('products/{slug}', [ProductsController::class, 'show'])->name('products.detail');

// Controller
Route::get('products', [ProductsController::class, 'index'])->name('products.index');
