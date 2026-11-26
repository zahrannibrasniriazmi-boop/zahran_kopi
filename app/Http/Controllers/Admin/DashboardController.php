<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan ringkasan statistik dan data terbaru di dashboard admin.
     */
    public function index(): View
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalStock = Product::sum('stock');
        $lowStockCount = Product::where('stock', '<=', 10)->count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();

        $recentProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        $categoriesSummary = Category::withCount('products')
            ->orderByDesc('products_count')
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalStock',
            'lowStockCount',
            'unreadMessages',
            'recentProducts',
            'categoriesSummary'
        ));
    }
}
