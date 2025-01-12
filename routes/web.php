<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/', function () {
    $featuredProducts = Product::take(8)->get();
    return view('home', compact('featuredProducts'));
})->name('home');

Route::get('/products', function () {
    $products = Product::all();
    return view('products.index', compact('products'));
})->name('products.index');

Route::get('/products/{product}', function (Product $product) {
    return view('products.show', compact('product'));
})->name('products.show');

Route::get('/categories', function () {
    $categories = Category::all();
    return view('categories.index', compact('categories'));
})->name('categories.index');

Route::get('/categories/{category}', function (Category $category) {
    $products = $category->products;
    return view('products.index', compact('products'));
})->name('categories.show');


Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
// Registrasi dan verifikasi email
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register.create');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

Route::get('verify-email', [VerificationController::class, 'input'])->name('verification.input');
Route::post('verify-email', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('resend-verification', [VerificationController::class, 'resend'])->name('verification.resend');

// Rute yang dipanggil oleh Laravel Breeze untuk resend email verification
Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

// Middleware untuk pengguna yang login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute otentikasi default Laravel Breeze
require __DIR__ . '/auth.php';
