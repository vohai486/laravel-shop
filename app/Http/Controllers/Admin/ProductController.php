<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Models\Category;
use App\Models\Product;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type = 'create';
        $categories = Category::all();
        $product = null;
        return view('admin.product.store', compact('type', 'categories', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {

        /** Handle image file */
        $imagePath = $this->uploadImage($request, 'image');

        $input = $request->only([
            'show_at_home',
            'status',
            'seo_description',
            'seo_title',
            'sku',
            'long_description',
            'short_description',
            'quantity',
            'price',
            'category_id',
            'name'
        ]);

        $input['thumb_image'] = $imagePath;
        $input['slug'] = Str::slug($input['name']);
        $product = Product::create($input);

        return to_route('admin.product.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $type = 'edit';
        $categories = Category::all();

        return view('admin.product.store', compact('type', 'categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductStoreRequest $request, Product $product)
    {
        $input = $request->only([
            'show_at_home',
            'status',
            'seo_description',
            'seo_title',
            'sku',
            'long_description',
            'short_description',
            'quantity',
            'price',
            'category_id',
            'name'
        ]);
        if ($request->has('image')) {
            /** Handle image file */
            $imagePath = $this->uploadImage($request, 'image', $product->thumb_image);
            $input['thumb_image'] = $imagePath;
        }
        $input['slug'] = Str::slug($input['name']);
        $product = $product->update($input);

        return to_route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Product::findOrFail($id)->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }
    }
}
