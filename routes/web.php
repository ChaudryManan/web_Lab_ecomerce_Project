<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Models\Product;
Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/signup', [AuthController::class, 'showSignup']);
Route::post('/signup', [AuthController::class, 'signup']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/dashboard', function () {

    $products = Product::latest()->get(); // get all products

    return view('auth.dashboard', compact('products'));

});
Route::get('/add-product', function () {
    return view('auth.addproduct');
})->name('add.product')->middleware('auth');
Route::post('/store-product', [ProductController::class, 'store'])->middleware('auth');
Route::get('/product/{id}', [ProductController::class, 'show'])->middleware('auth');
Route::post('/add-to-cart/{id}', [CartController::class, 'add'])->middleware('auth');
Route::get('/cart', [CartController::class, 'index'])->middleware('auth');
Route::get('/checkout', [OrderController::class, 'checkoutPage'])->middleware('auth')->name('checkout.page');

Route::post('/place-order', [OrderController::class, 'placeOrder'])->middleware('auth')->name('place.order');
Route::post('/buy-now/{id}', [OrderController::class, 'buyNow'])->middleware('auth');
Route::get('/admin/dashboard', [OrderController::class, 'adminDashboard'])->middleware('auth');
Route::get('/admin/products', [AdminController::class, 'products'])->middleware('auth');
Route::get('/admin/products/{id}/edit', [AdminController::class, 'editProduct'])->middleware('auth');
Route::put('/admin/products/{id}', [AdminController::class, 'updateProduct'])->middleware('auth');
Route::delete('/admin/products/{id}', [AdminController::class, 'deleteProduct'])->middleware('auth');
Route::get('/admin/orders', [AdminController::class, 'orders'])->middleware('auth');
Route::post('/admin/orders/{id}/complete', [AdminController::class, 'completeOrder'])->middleware('auth');
Route::get('/admin/customers', [AdminController::class, 'customers'])->middleware('auth');
Route::get('/admin/reports', [AdminController::class, 'reports'])->middleware('auth');
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);
Route::post('/update-cart/{id}', [CartController::class, 'update'])->name('update.cart')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');