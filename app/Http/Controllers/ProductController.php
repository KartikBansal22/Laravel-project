<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Product::query()->where('is_active', true);

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(9)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}