<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // Assuming Model

class HomeController extends Controller
{
    public function index()
    {
        // 1. Deals (Featured products)
        // In the seeder we marked the "Deals" section items as is_featured=1
        $deals = Product::where('is_featured', true)->take(4)->get();

        // 2. Bags 
        $bags = Product::whereHas('category', function($q) {
            $q->whereIn('slug', ['tote-bags', 'shoulder-bags']);
        })->take(4)->get();

        // 3. Fans
        $fans = Product::whereHas('category', function($q) {
            $q->where('slug', 'fans');
        })->take(4)->get();

        // 4. Stationery (General mix)
        $stationery = Product::whereHas('category', function($q) {
            $q->whereIn('slug', ['pen-and-pencils', 'markers-and-highlighters', 'cutters-and-staplers']);
        })->take(4)->get();

        return view('home', compact('deals', 'bags', 'fans', 'stationery'));
    }
}
