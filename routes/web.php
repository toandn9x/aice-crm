<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Middleware\CheckSessionExpired;

Route::get('/', function () {
    return view('welcome');
});
// Nhóm route KHÔNG cần đăng nhập (login, logout)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.plogin');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Nhóm route CẦN đăng nhập
Route::middleware(['auth', CheckSessionExpired::class])->prefix('admin')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::get('/index', [IndexController::class, 'index'])->name('admin.index');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('/api/customers/{id}', [CustomerController::class, 'get'])->name('customers.get'); // API JSON
    Route::post('/customers/update/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/delete/{id}', [CustomerController::class, 'delete'])->name('customers.delete');
});

