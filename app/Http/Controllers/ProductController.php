<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk UMKM dengan fitur pencarian, filter kategori, dan pengurutan.
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));
        $categorySlug = trim((string) $request->query('kategori', ''));
        $sort = (string) $request->query('urutkan', 'terbaru');

        $query = Product::with('category');

        if ($search !== '') {
            $query->where(function ($q) use ($search): void {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('seller_name', 'like', "%{$search}%");
            });
        }

        $activeCategory = null;
        if ($categorySlug !== '') {
            $activeCategory = Category::where('slug', $categorySlug)->first();
            if ($activeCategory) {
                $query->where('category_id', $activeCategory->id);
            }
        }

        match ($sort) {
            'termurah' => $query->orderBy('price', 'asc'),
            'termahal' => $query->orderBy('price', 'desc'),
            default => $query->latest(),
        };

        $products = $query->paginate(9)->withQueryString();
        $categories = Category::withCount('products')->orderBy('name')->get();

        return view('pages.products.index', compact(
            'products',
            'categories',
            'activeCategory',
            'search',
            'categorySlug',
            'sort'
        ));
    }

    /**
     * Menampilkan halaman detail produk berdasarkan slug.
     */
    public function show(string $slug): View
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        return view('pages.products.show', compact('product', 'relatedProducts'));
    }
}
