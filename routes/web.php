<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontEndController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\ReviewController;

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

Route::get('/', [FrontEndController::class, 'index'])->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /** Cart */
    Route::post('/cart', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/get-cart-products', [CartController::class, 'getCartProduct'])->name('get-cart-products');
    Route::post('/cart-update-qty', [CartController::class, 'cartQtyUpdate'])->name('cart.quantity-update');
    Route::post('/cart-product-remove', [CartController::class, 'cartProductRemove'])->name('cart-product-remove');
    Route::get('/get-count-cart', [CartController::class, 'getCountCart'])->name('get-count-cart');

    /** Checkout */
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'createOrder'])->name('create-order');

    /** Coupon */
    Route::post('/apply-coupon', [FrontendController::class, 'applyCoupon'])->name('apply-coupon');

    //** Review */
    Route::resource('products.reviews', ReviewController::class)->shallow();
});


Route::get('/test', function () {
    return view('auth.layouts.master');
});

require __DIR__ . '/auth.php';

Route::get('/{product:slug}', [FrontEndController::class, 'showProduct'])->name('product.show');