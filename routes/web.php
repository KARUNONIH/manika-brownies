<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\userController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\KategoriController;


Route::get('/', [userController::class, 'index'])->name('home');
Route::get('/dataProduct', [userController::class, 'dataProduct']);

// Route::resource('myadmin', ProductController::class);
// Route::post('myadmin/{kode_kue}/set-bs', [ProductController::class, 'setBestSeller']);

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::resource('transactions', TransactionController::class);

// Route::get('/sales', [TransactionController::class, 'sales'])->name('sales.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/adminmanika', [adminController::class, 'index'])->name('admin.index');
    Route::resource('myadmin', ProductController::class);
    Route::get('/dataProductAdmin', [ProductController::class, 'dataProduct']);
    Route::post('myadmin/{kode_kue}/set-bs', [ProductController::class, 'setBestSeller']);
    Route::resource('transactions', TransactionController::class);
    Route::get('/sales', [TransactionController::class, 'sales'])->name('sales.index');
    Route::delete('/transactions/{nama_pembeli}/{created_at}', [TransactionController::class, 'delete'])->name('transactions.delete');
    Route::patch('/transactions/status-update/{nama_pembeli}/{created_at}/{status}', [TransactionController::class, 'statusUpdate'])->name('transactions.statusUpdate');

    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');


    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


});

Route::get('/login', [LoginController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login_action'])->middleware('guest')->name('login_action');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
