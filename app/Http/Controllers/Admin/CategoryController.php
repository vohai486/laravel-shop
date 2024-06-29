<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.store', ['type' => 'create']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $input = $request->only(['name', 'show_at_home', 'status']);
        $input['slug'] = Str::slug($input['name']);
        $category = Category::create($input);
        // toastr()->success('Created Successfully');
        return to_route('admin.category.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.store', ['type' => 'edit', 'category' => $category]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryStoreRequest $request, Category $category)
    {
        $input = $request->only(['name', 'show_at_home', 'status']);
        $input['slug'] = Str::slug($input['name']);
        $category = $category->update($input);
        return to_route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Category::findOrFail($id)->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }
    }
}
