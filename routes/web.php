<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Customer\HomeController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('landing');


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

        Route::get('/dashboard', function () {
            abort_if(auth()->user()->role !== 'admin', 403);
            return view('admin.dashboard');
        })->name('dashboard');

        // 🔥 RESOURCE ROUTES (IMPORTANT)
        Route::resource('user', UserController::class);
        Route::resource('products', ProductController::class);
        Route::resource('categories', ProductCategoryController::class);
        Route::resource('transactions', TransactionController::class);
    });
