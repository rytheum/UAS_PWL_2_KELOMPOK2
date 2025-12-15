<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {

    if (auth()->check() && auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return view('landingpage.index');

})->name('landing');

/*
|--------------------------------------------------------------------------
| Auth (Login & Register - satu halaman)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // halaman auth (login + register)
    Route::get('/auth', function () {
        return view('auth.auth');
    })->name('auth');

    /**
     * IMPORTANT:
     * Laravel butuh route bernama "login"
     * Jadi kita redirect ke /auth
     */
    Route::get('/login', fn() => redirect()->route('auth'))->name('login');
    Route::get('/register', fn() => redirect()->route('auth'))->name('register');

    // proses login & register
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');
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
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {

        abort_if(auth()->user()->role !== 'admin', 403);

        return view('admin.dashboard');

    })->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::resource('categories', ProductCategoryController::class);
    Route::resource('transactions', TransactionController::class);
});
