<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'orderItems')->latest()->get();
        return view('admin.order.index', compact('orders'));
    }
    public function show(string $id)
    {
        $order = Order::where(['id' => $id])->with('user', 'orderItems', 'orderItems.product')->first();
        return view('admin.order.show', compact('order'));
    }
    public function destroy()
    {
    }

}
