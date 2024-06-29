<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CheckoutRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = $user->cart;
        $cartItems = [];
        if ($cart) {
            $cartItems = $cart->with(
                'cartItems.product',
                'cartItems.productVariant'
            )->first()->cartItems;
        }
        if (count($cartItems) == 0) {
            return to_route('cart.index');
        }
        $discount = 0;
        if (session()->exists('coupon')) {
            $discount = session()->get('coupon')['discount'];
        }
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->productVariant->price * $item->qty;
        }
        session()->put('totalPrice', $totalPrice);
        return view('frontend.pages.checkout', compact('cartItems', 'discount', 'totalPrice'));
    }
    public function createOrder(CheckoutRequest $request)
    {
        try {
            $user = Auth::user();
            $cart = $user->cart;
            $cartItems = [];
            if ($cart) {
                $cartItems = $cart->with(
                    'cartItems.product',
                    'cartItems.productVariant'
                )->first()->cartItems;
            }
            if (count($cartItems) == 0) {
                return redirect()->back();
            }
            $input = $request->only([
                'fullname',
                'address',
                'phone',
                'email',
                'note',
            ]);
            $input['discount'] = 0;
            if (session()->exists('coupon')) {
                $coupon = session()->get('coupon');
                $code = $coupon['code'];
                $coupon = Coupon::where('code', $code)->where(
                    'qty',
                    '>=',
                    '1'
                )->where('expire_date', '>', Carbon::now())->first();
                if ($coupon) {
                    $input['discount'] = $coupon['discount'];
                    $input['coupon_info'] = json_encode([
                        'name' => $coupon->name,
                        'discount_type' => $coupon->discount_type,
                        'discount' => $coupon->discount,
                    ]);
                }
            }
            if (session()->exists('totalPrice')) {
                $input['total_money'] = session()->get('totalPrice');
            }

            $order = $user->orders()->create($input);

            foreach ($cartItems as $item) {

                if ($item->productVariant->inventory_quantity < $item->qty) {
                    return redirect()->back();
                }
                $order->orderItems()->create([
                    'product_id' => $item->product->id,
                    'title' => $item->product->name . ' - ' . $item->productVariant->title,
                    'price' => $item->productVariant->price,
                    'name' => $item->product->name,
                    'qty' => $item->qty
                ]);
                $item->productVariant->decrement('inventory_quantity', $item->qty);
                $item->delete();
            }
            return to_route('home');
        } catch (\Exception $e) {
            return redirect()->back();
        }

    }
}
