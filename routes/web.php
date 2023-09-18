<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'auth'], function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.post');
        Route::get('/register', [RegisterController::class, 'index'])->name('register');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
    }) ;
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});
Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'isAdmin']);
    Route::controller(CategoryController::class)->group(function() {
        Route::get('/category', 'index')->name('admin.category.list');
        Route::get('/category/create', 'create')->name('admin.category.create');
        Route::post('/category/create', 'store')->name('admin.category.store');
        Route::get('/category/{id}/edit', 'edit')->name('admin.category.edit');
        Route::post('/category/{id}/edit', 'update')->name('admin.category.update');
        Route::delete('/category/{id}', 'destroy')->name('admin.category.delete');
    });
});
Route::get('/', [HomeController::class, 'index']);
Route::prefix('shop')->group(function() {
    Route::controller(ShopController::class)->group(function() {
        Route::get('/', 'index');
    });
});



