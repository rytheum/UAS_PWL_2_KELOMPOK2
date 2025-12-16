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

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        ProductCategory::create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully');
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $data = $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $productCategory->update($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete(); // nullOnDelete ke products

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
