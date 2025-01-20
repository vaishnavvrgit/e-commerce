<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/rollback', function () {
    Artisan::call('migrate:rollback');
    dd(Artisan::output());
});


Route::get('/migrate', function () {
    Artisan::call('migrate');
    dd(Artisan::output());
});
Route::get('/fresh', function () {
    Artisan::call('migrate:fresh');
    dd(Artisan::output());
});


Route::get('/db-seed', function () {
    Artisan::call('db:seed');
    dd(Artisan::output());
});
/*****************developer ******************************* */

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login_submit', [AuthController::class, 'login_submit'])->name('login_submit');
