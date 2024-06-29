<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FrontEndController extends Controller
{
    public function index()
    {
        $categories = Category::with([
            'products' => function ($query) {
                return $query->where([
                    'show_at_home' => 1,
                    'status' => 1,
                ])->orderBy('id', 'DESC')
                    ->take(8)->get();
            }
        ])->get();


        return view('frontend.home.index', compact('categories'));
    }
    public function showProduct(Product $product)
    {
        $relatedProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->take(8)->latest()->get();

        $product = Cache::remember("product-{$product->id}", 60, function () use ($product) {
            return $product->load('category', 'variants', 'options', 'reviews');
        });

        return view('frontend.pages.product-view', compact('product', 'relatedProducts'));
    }
    public function applyCoupon(Request $request)
    {
        $subtotal = $request->subtotal;
        $code = $request->code;

        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return response(['message' => 'Invalid Coupon Code.'], 422);
        }
        if ($coupon->qty <= 0) {
            return response(['message' => 'Coupon has been fully redeemed'], 422);
        }
        if ($coupon->expire_date < now()) {
            return response(['message' => 'Coupon hs expired.'], 422);
        }
        if ($subtotal < $coupon->min_purchase_amount) {
            return response(['message' => 'Min purchase amount is not enough'], 422);
        }

        if ($coupon->discount_type === 'percent') {
            $discount = $subtotal * ($coupon->discount / 100);
        } elseif ($coupon->discount_type === 'amount') {
            $discount = $coupon->discount;
        }
        $finalTotal = $subtotal - $discount;

        session()->put('coupon', ['code' => $code, 'discount' => $discount]);

        return response(['message' => 'Coupon Applied Successfully.', 'discount' => $discount, 'finalTotal' => $finalTotal, 'coupon_code' => $code]);
    }
}
