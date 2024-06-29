<?php

use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductOptionController;
use App\Http\Controllers\Admin\ProductVariantController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->name('admin.')->group(function () {
  Route::get('/dashboard', DashboardController::class)->name('dashboard');

  Route::resource('category', CategoryController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

  Route::resource('product', ProductController::class);

  Route::resource('coupon', CouponController::class);

  // Orders
  Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
  Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
  Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

  // Product Variant
  Route::get('product-variant/{product}', [ProductVariantController::class, 'index'])->name('product-variant.show-index');
  Route::resource('product-variant', ProductVariantController::class);

  // Product Option
  Route::resource('product-option', ProductOptionController::class);

});