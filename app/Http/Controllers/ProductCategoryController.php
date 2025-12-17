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

        ProductCategory::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully');
    }

    // ✅ FIX
    public function edit(ProductCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function show(ProductCategory $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    // ✅ FIX
    public function update(Request $request, ProductCategory $category)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(ProductCategory $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
