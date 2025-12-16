<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::withCount('products')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        ProductCategory::create([
            'category_name' => $validated['category_name'],
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully');
    }

    public function show($id){
        $productCategory = ProductCategory::findOrFail($id);

        return view('admin.products.show', compact('categories'));
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $productCategory->update([
            'category_name' => $validated['category_name'],
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully');
    }
}