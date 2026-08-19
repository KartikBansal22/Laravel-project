<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'       => ['nullable', 'exists:categories,id'],
            'name'              => ['required', 'max:255'],
            'description'       => ['nullable', 'string'],
            'price'             => ['required', 'numeric', 'min:0'],
            'stock_quantity'    => ['required', 'integer', 'min:0'],
            'reorder_threshold' => ['nullable', 'integer', 'min:0'],
            'image'             => ['nullable', 'image', 'max:2048'],
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(6);
        $validated['is_active'] = true;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created!');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id'       => ['nullable', 'exists:categories,id'],
            'name'              => ['required', 'max:255'],
            'description'       => ['nullable', 'string'],
            'price'             => ['required', 'numeric', 'min:0'],
            'stock_quantity'    => ['required', 'integer', 'min:0'],
            'reorder_threshold' => ['nullable', 'integer', 'min:0'],
            'is_active'         => ['nullable', 'boolean'],
            'image'             => ['nullable', 'image', 'max:2048'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted!');
    }
}