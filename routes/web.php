<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;

// Homepage route (public access)
Route::get('/', [HomeController::class, 'index'])
->name('home');

// Menu routes (public access)
Route::get('/kue-tart', [MenuController::class, 'kueTart']
)->name('menu.kue-tart');
Route::get('/brownies', [MenuController::class, 'brownies'])
->name('menu.brownies');
Route::get('/bento-cake', [MenuController::class, 'bentoCake'])
->name('menu.bento-cake');
Route::get('/lekker-holland', [MenuController::class, 'lekkerHolland'])
->name('menu.lekker-holland');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])
->name('login');
Route::post('/login', [AuthController::class, 'login'])
->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])
->name('register');
Route::post('/register', [AuthController::class, 'register'])
->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])
->name('logout');

// Dashboard routes (protected)
Route::middleware(['auth', 'admin'])
->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');
    Route::get('/admin/orders', [AdminController::class, 'orders'])
    ->name('admin.orders');
    Route::match(['get', 'post'], '/admin/cek-po', [HomeController::class, 'trackOrderByPo'])
    ->name('admin.order.track');
    Route::patch('/admin/orders/{id}/status', [AdminController::class,
     'updateOrderStatus'])->name('admin.orders.update-status');
    Route::get('/admin/menus', [AdminController::class, 'menus'])
    ->name('admin.menus');
    Route::post('/admin/menus', [AdminController::class, 'storeMenu'])
    ->name('admin.menus.store');
    Route::put('/admin/menus/{id}', [AdminController::class, 'updateMenu'])
    ->name('admin.menus.update');
    Route::delete('/admin/menus/{id}', [AdminController::class, 'destroyMenu'])
    ->name('admin.menus.destroy');
});

Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class,
     'dashboard'])->name('customer.dashboard');
    Route::get('/customer/create-order', [CustomerController::class,
     'createOrder'])->name('customer.create-order');
    Route::get('/customer/orders', [CustomerController::class,
     'orders'])->name('customer.orders');
    Route::get('/customer/pickup-slots', [CustomerController::class,
     'getAvailablePickupSlots'])->name('customer.pickup-slots');
    Route::post('/customer/orders', [CustomerController::class, 
    'storeOrder'])->name('customer.orders.store');
});
