<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/shop', [App\Http\Controllers\HomeController::class, 'shop'])->name('shop');
Route::get('/cart', [App\Http\Controllers\HomeController::class, 'cart'])->name('cart');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/category/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('products.show');
Route::post('/products/men/search', [App\Http\Controllers\ProductController::class, 'search'])->name('products.men.search');
Route::get('/products/type', [App\Http\Controllers\ProductController::class, 'select'])->name('products.type');
Route::get('/men', [App\Http\Controllers\ProductController::class, 'index'])->name('men');
Route::get('/women', [App\Http\Controllers\ProductController::class, 'women'])->name('women');
Route::get('/accessory', [App\Http\Controllers\ProductController::class, 'accessory'])->name('accessory');
Route::get('/products/{id}/show', [App\Http\Controllers\ProductController::class, 'show'])->name('product.women');
Route::get('/products/detail/{id}', [App\Http\Controllers\ProductController::class, 'detail'])->name('detail');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::middleware('auth')->group(function () {

    Route::get('/cart', [CartController::class, 'index'])->name("cart.index");
    Route::get('/cart/delete', [CartController::class, 'delete'])->name("cart.delete");
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name("cart.add");
    Route::post('/product/rate', [ProductController::class, 'rate'])->name("product.rating");
    Route::post('/my-account/orders/{id}/delivered', [MyAccountController::class, 'delivered'])->name("myaccount.delivered");
    Route::get('/cart/purchase', [CartController::class, 'purchase'])->name("cart.purchase");
    Route::get('/my-account/orders', [MyAccountController::class, 'orders'])->name("myaccount.orders");
});

Route::prefix('admin')->group(function () {
    Route::get('/user', [AdminUserController::class, 'index'])->name("admin.users");
    Route::delete('/users/{id}/delete', [AdminUserController::class, 'delete'])->name("admin.user.delete");
    Route::post('/users/{id}/update', [AdminUserController::class, 'update'])->name("admin.user.update");
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name("admin.user.edit");


    Route::get('/product/{id}', [AdminProductController::class, 'show'])->name("admin.product.show");
    Route::get('/product', [AdminProductController::class, 'index'])->name("admin.product.index");
    Route::post('/product/store', [AdminProductController::class, 'store'])->name("admin.product.store");
    Route::delete('/product/{id}/delete', [AdminProductController::class, 'delete'])->name("admin.product.delete");
    Route::post('/product/{id}/update', [AdminProductController::class, 'update'])->name("admin.product.update");
    Route::delete('/product/{id}/image/delete', [AdminProductController::class, 'deleteImage'])->name("admin.product.image.delete");
    Route::post('/product/image', [AdminProductController::class, 'image'])->name("admin.product.image");

    Route::get('/category/{id}', [AdminCategoryController::class, 'show'])->name("admin.category.show");
    Route::get('/category', [AdminCategoryController::class, 'index'])->name("admin.category.index");
    Route::post('/category/store', [AdminCategoryController::class, 'store'])->name("admin.category.store");
    Route::delete('/category/{id}/delete', [AdminCategoryController::class, 'delete'])->name("admin.category.delete");
    Route::post('/category/{id}/update', [AdminCategoryController::class, 'update'])->name("admin.category.update");

    Route::get('/orders', [AdminOrderController::class, 'orders'])->name("admin.orders");
    Route::get('/orders/{id}/delivered', [AdminOrderController::class, 'delivered'])->name("admin.delivered");


});


