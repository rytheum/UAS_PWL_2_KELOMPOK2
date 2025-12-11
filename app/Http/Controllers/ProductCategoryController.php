<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return ProductCategory::withCount('products')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        return ProductCategory::create($data);
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $data = $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $productCategory->update($data);

        return $productCategory;
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete(); // otomatis nullOnDelete ke product
        return response()->json(['message' => 'Category deleted']);
    }
}
