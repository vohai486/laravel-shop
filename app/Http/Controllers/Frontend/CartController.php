<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {

        return view('frontend.pages.cart-view');
    }
    public function getCountCart()
    {
        $user = Auth::user();
        if (!$user) {
            return 0;
        }
        $cart = $user->cart;
        $count = 0;
        if ($cart) {
            $count = $cart->cartItems->count();
        } else {
            $count = 0;
        }
        return $count;
    }

    public function addToCart(Request $request)
    {
        try {
            $productId = $request->product_id;
            $qty = $request->qty;
            $variantId = $request->variant_id;
            $cart = Cart::firstOrCreate(
                ['user_id' => $request->user()->id]
            );

            $cartItem = $cart->cartItems()->where('product_id', $productId)->where('variant_id', $variantId)->first();
            if (!$cartItem) {
                $cart->cartItems()->create([
                    'product_id' => $productId,
                    'qty' => $qty,
                    'variant_id' => $variantId
                ]);
            } else {
                $cartItem->update([
                    'qty' => $cartItem->qty + $qty,
                ]);
            }

            return response(['status' => 'success', 'message' => 'Product added into cart!'], 200);
        } catch (\Exception $e) {
            dd($e);
            return response(['status' => 'error', 'message' => 'Something went wrong!'], 500);
        }
    }
    public function getCartProduct()
    {
        $user = Auth::user();
        $cart = $user->cart;
        $cartItems = [];
        if ($cart) {
            // $cartItems = $cart->with('cartItems.product')->get()[0]->cartItems;
            $cartItems = $cart->with('cartItems.product', 'cartItems.productVariant')->first()->cartItems;
        } else {
            $cartItems = [];
        }

        $subTotalPrice = 0;
        foreach ($cartItems as $item) {
            $subTotalPrice += $item->productVariant->price * $item->qty;
        }

        return view('frontend.layouts.ajax.list-cart-item', compact('cartItems', 'subTotalPrice'))->render();
    }
    public function cartQtyUpdate(Request $request)
    {
        try {
            $qty = (int) request('qty');
            if ($qty === 0) {
                CartItem::where(
                    ['id' => request('cart_item_id')]
                )->delete();
            } else {
                $cartItem = CartItem::updateOrCreate(
                    ['id' => request('cart_item_id')],
                    ['qty' => request('qty')]
                );
            }

            return response(['status' => 'success', 'message' => 'Product updated into cart!'], 200);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong!'], 500);
        }



    }
    public function cartProductRemove(Request $request)
    {
        try {
            $cartItem = CartItem::where(
                ['id' => request('cart_item_id')]
            )->delete();
            return response(['status' => 'success', 'message' => 'Product deleted into cart!'], 200);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong!'], 500);
        }
    }
}
