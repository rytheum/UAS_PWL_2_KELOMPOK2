<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;


/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('landing');
/*
|--------------------------------------------------------------------------
| Product Detail (Landing Page)
|--------------------------------------------------------------------------
*/
Route::get('/product/{product}', [HomeController::class, 'detail'])
    ->name('product.detail');


Route::post('/checkout', [CheckoutController::class, 'index'])->name('checkout.instant');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

Route::post('/payment', [PaymentController::class, 'index'])
    ->name('payment.index');
Route::post('/payment/process', [PaymentController::class, 'process'])
    ->name('payment.process');

// web.php
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
Route::get('/transaction/{id}', [TransactionController::class, 'show'])->name('transaction.detail');



    

/*
|--------------------------------------------------------------------------
| Auth (Login & Register)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/auth', fn() => view('auth.auth'))->name('auth');

    // Laravel butuh route bernama "login"
    Route::get('/login', fn() => redirect()->route('auth'))->name('login');
    Route::get('/register', fn() => redirect()->route('auth'))->name('register');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');
});

// Di dalam middleware auth



// Di dalam middleware auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
     Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id_cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id_cart}', [CartController::class, 'destroy'])->name('cart.delete');

    // Checkout dari Cart
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Area
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // 🔥 RESOURCE ROUTES (IMPORTANT)
        Route::resource('user', UserController::class);
        Route::resource('products', ProductController::class);

        Route::resource('categories', ProductCategoryController::class);
        Route::resource('transactions', TransactionController::class);
    });
