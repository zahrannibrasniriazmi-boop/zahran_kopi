<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman beranda marketplace @difMarket.
     */
    public function index(): View
    {
        $featuredProducts = Product::with('category')
            ->where('is_featured', true)
            ->latest()
            ->take(4)
            ->get();

        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::with('category')->latest()->take(4)->get();
        }

        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        $latestProducts = Product::with('category')
            ->latest()
            ->take(8)
            ->get();

        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'partners' => Product::whereNotNull('seller_name')->distinct('seller_name')->count('seller_name') ?: 12,
        ];

        return view('pages.home', compact('featuredProducts', 'categories', 'latestProducts', 'stats'));
    }

    /**
     * Menampilkan halaman Tentang Kami.
     */
    public function about(): View
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
        ];

        return view('pages.about', compact('stats'));
    }
}
