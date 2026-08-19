<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('name')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255', 'unique:categories,name'],
        ]);

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return back()->with('success', 'Category added!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Category deleted!');
    }
}