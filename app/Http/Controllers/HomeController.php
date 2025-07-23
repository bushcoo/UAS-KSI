<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        try {
            $featuredProducts = Product::where('is_active', true)
                ->latest()
                ->take(8)
                ->get();
                
            $categories = Category::where('is_active', true)
                ->withCount('products')
                ->get();

            return view('home', compact('featuredProducts', 'categories'));
        } catch (\Exception $e) {
            // Log error jika terjadi masalah
            Log::error('Error in HomeController@index: ' . $e->getMessage());
            
            // Return view dengan data kosong jika terjadi error
            return view('home', [
                'featuredProducts' => collect(),
                'categories' => collect()
            ]);
        }
    }
}
