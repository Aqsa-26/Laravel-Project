<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('frontend.products.show', compact('product'));
    }

    public function byCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->where('is_active', true)->get();
        $categoryName = $category->name;
        
        return view('frontend.products.category', compact('products', 'categoryName', 'slug'));
    }

    public function newArrivals()
    {
        $products = Product::latest()->take(12)->get();
        return view('frontend.products.new-arrivals', compact('products'));
    }
}
