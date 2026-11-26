<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Menampilkan seluruh kategori beserta daftar produk di tiap kategori.
     */
    public function index(): View
    {
        $categories = Category::withCount('products')
            ->with(['products' => fn ($query) => $query->latest()->take(4)])
            ->orderBy('name')
            ->get();

        return view('pages.categories.index', compact('categories'));
    }

    /**
     * Menampilkan seluruh produk dalam satu kategori terpilih.
     */
    public function show(string $slug): View
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->with('category')->latest()->paginate(9);
        $categories = Category::withCount('products')->orderBy('name')->get();

        return view('pages.categories.show', compact('category', 'products', 'categories'));
    }
}
