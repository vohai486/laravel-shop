<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductOption;
use Illuminate\Http\Request;

class ProductOptionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'position' => ['required', 'integer'],
            'product_id' => ['required', 'integer']
        ], [
            'required' => 'Vui lòng nhập',
            'size' => 'Không được quá :max kí tự',
            'integer' => 'Phải là số nguyên',
        ]);
        $option = ProductOption::create($request->only(['name', 'position', 'product_id']));
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
