<?php

use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\Category;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;


Route::name('admin.')->prefix('admin')->group(function () {

    Route::middleware('guest:web,admin')->group(function () {
        Route::get('/login', [AdminMainController::class, 'login'])->name('login');
        Route::post('/login', [AdminMainController::class, 'loginSubmit']);
    });

    Route::middleware(['auth:admin', 'isAdmin'])->group(function () {

        Route::get('/', [AdminMainController::class, 'index']);

        Route::get('/dashboard', [AdminMainController::class, 'index'])->name('dashboard');

        Route::get('/logout', [AdminMainController::class, 'logout'])->name('logout');

        Route::prefix('category')->name('category.')->group(function () {

            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/{category}/show', [CategoryController::class, 'show'])->name('show');
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/{category}/update', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{category}/destroy', [CategoryController::class, 'destroy'])->name('destroy');

        });



    });
});