<?php

use App\Livewire\Admin\Brand\Index;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductColorController;

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

    Route::controller(BrandController::class)->group(function() {
        Route::get('/brand', 'index')->name('admin.brand.list');
        Route::get('/brand/create', 'create')->name('admin.brand.create');
        Route::get('/brand/{id}/edit', 'edit')->name('admin.brand.edit');
        Route::put('/brand/{id}/edit', 'update')->name('admin.brand.update');
        Route::delete('/brand/{id}', 'destroy')->name('admin.brand.delete');
    });
    Route::controller(ProductController::class)->group(function() {
        Route::get('/product', 'index')->name('admin.product.list');
        Route::get('/product/create', 'create')->name('admin.product.create');
        Route::post('/product/create', 'store')->name('admin.product.store');
        Route::get('/product/{id}/edit', 'edit')->name('admin.product.edit');
        Route::put('/product/{id}/edit', 'update')->name('admin.product.update');
        Route::delete('/product/{id}', 'destroy')->name('admin.product.delete');

    });
    Route::controller(ProductImageController::class)->group(function() {

        Route::get('/images/{id}', 'destroy')->name('admin.images.delete');

    });
//CRUD Color
    Route::controller(ColorController::class)->group(function() {
        Route::get('/color', 'index')->name('admin.color.list');
        Route::get('/color/create', 'create')->name('admin.color.create');
        Route::post('/color/create', 'store')->name('admin.color.store');
        Route::get('/color/{id}/edit', 'edit')->name('admin.color.edit');
        Route::put('/color/{id}/edit', 'update')->name('admin.color.update');
        Route::delete('/color/{id}', 'destroy')->name('admin.color.delete');

    });
    Route::controller(ProductColorController::class)->group(function() {
        Route::get('/productcolor', 'index')->name('admin.color.list');
        Route::get('/productcolor/create', 'create')->name('admin.p.color.create');
        Route::post('/productcolor/create', 'store')->name('admin.p.color.store');
        Route::get('/productcolor/{id}/edit', 'edit')->name('admin.p.color.edit');
        Route::post('/productcolor/{id}/edit', 'update')->name('admin.p.color.update');
        Route::delete('/productcolor/{id}', 'destroy')->name('admin.p.color.delete');

    });

    // Route::controller()->group(function() {
    //     Route::get('/brand')->name('admin.brand.list');
    //     Route::get('/category/create', 'create')->name('admin.category.create');
    //     Route::post('/category/create', 'store')->name('admin.category.store');
    //     Route::get('/category/{id}/edit', 'edit')->name('admin.category.edit');
    //     Route::post('/category/{id}/edit', 'update')->name('admin.category.update');
    //     Route::delete('/category/{id}', 'destroy')->name('admin.category.delete');
    // });
});
Route::get('/', [HomeController::class, 'index']);
Route::prefix('shop')->group(function() {
    Route::controller(ShopController::class)->group(function() {
        Route::get('/', 'index');
    });
});

Route::post('/update-pcolor',   function ( ) {
    // Xử lý dữ liệu của form con ở đây
    // request()->qty . request()->id
   $id = request()->id;
   $qty = request()->qty;

$data = [
    'id' => $id,
    'qty' => $qty
];

       return response()->json($data, 200)  ;
}
);

// FormController

