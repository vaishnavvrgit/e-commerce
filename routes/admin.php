<?php

use App\Http\Controllers\Admin\AdminMainController;
use Illuminate\Support\Facades\Route;


Route::name('admin.')->prefix('admin')->group(function () {

    Route::middleware('guest:web,admin')->group(function () {
        Route::get('/login', [AdminMainController::class, 'login'])->name('login');
        Route::post('/login', [AdminMainController::class, 'loginSubmit']);
    });

    Route::middleware(['auth:admin', 'isAdmin'])->group(function () {

        Route::get('/', [AdminMainController::class, 'index']);

        Route::get('/dashboard', [AdminMainController::class, 'index'])->name('dashboard');

    });
});