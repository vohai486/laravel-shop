<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponStoreRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type = 'create';
        return view('admin.coupon.store', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponStoreRequest $request)
    {
        $input = $request->only([
            'name',
            'code',
            'qty',
            'min_purchase_amount',
            'expire_date',
            'discount_type',
            'discount',
            'status',
        ]);
        $coupon = Coupon::create($input);
        return to_route('admin.coupon.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        $type = 'edit';
        return view('admin.coupon.store', compact('type', 'coupon'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponStoreRequest $request, Coupon $coupon)
    {
        $input = $request->only([
            'name',
            'code',
            'qty',
            'min_purchase_amount',
            'expire_date',
            'discount_type',
            'discount',
            'status',
        ]);
        $coupon = $coupon->update($input);
        return to_route('admin.coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Coupon::findOrFail($id)->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }
    }
}
