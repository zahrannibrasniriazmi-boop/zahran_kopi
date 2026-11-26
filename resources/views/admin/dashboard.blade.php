@extends('layouts.admin')

@section('title', 'Dashboard Admin — @difMarket')
@section('page_title', 'Ringkasan Dashboard')
@section('page_subtitle', 'Statistik katalog produk dan aktivitas marketplace @difMarket')

@section('content')
    <!-- Kartu Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Produk</span>
                <span class="w-10 h-10 rounded-2xl bg-[#F1ECFB] text-[#6C4AB6] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </span>
            </div>
            <div class="mt-3 text-3xl font-extrabold text-[#20243A]">{{ $totalProducts }}</div>
            <a href="{{ route('admin.products.index') }}" class="mt-2 inline-block text-xs font-bold text-[#6C4AB6] hover:underline">
                Kelola semua produk &rarr;
            </a>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Kategori</span>
                <span class="w-10 h-10 rounded-2xl bg-[#FFF3E6] text-[#FF9F43] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                </span>
            </div>
            <div class="mt-3 text-3xl font-extrabold text-[#20243A]">{{ $totalCategories }}</div>
            <a href="{{ route('admin.categories.index') }}" class="mt-2 inline-block text-xs font-bold text-[#FF9F43] hover:underline">
                Kelola kategori &rarr;
            </a>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Unit Stok</span>
                <span class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
            </div>
            <div class="mt-3 text-3xl font-extrabold text-[#20243A]">{{ number_format($totalStock, 0, ',', '.') }}</div>
            <p class="mt-2 text-xs font-medium text-slate-500">
                {{ $lowStockCount }} produk stok menipis (&le; 10)
            </p>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Pesan Belum Dibaca</span>
                <span class="w-10 h-10 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </span>
            </div>
            <div class="mt-3 text-3xl font-extrabold text-[#20243A]">{{ $unreadMessages }}</div>
            <a href="{{ route('admin.messages.index') }}" class="mt-2 inline-block text-xs font-bold text-sky-600 hover:underline">
                Lihat pesan kontak &rarr;
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Produk Terbaru -->
        <div class="lg:col-span-8 bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-extrabold text-[#20243A]">Produk Terbaru</h2>
                    <p class="text-xs text-slate-500">5 produk terakhir yang ditambahkan ke database</p>
                </div>
                <a href="{{ route('admin.products.create') }}"
                   class="px-4 py-2 rounded-full bg-[#F1ECFB] hover:bg-[#6C4AB6] text-[#6C4AB6] hover:text-white text-xs font-bold transition-colors">
                    + Produk Baru
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-[#F8F9FC] text-xs uppercase text-slate-500">
                        <tr>
                            <th class="px-6 py-3.5 font-bold">Produk</th>
                            <th class="px-4 py-3.5 font-bold">Kategori</th>
                            <th class="px-4 py-3.5 font-bold">Harga</th>
                            <th class="px-4 py-3.5 font-bold">Stok</th>
                            <th class="px-6 py-3.5 font-bold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($recentProducts as $product)
                            <tr class="hover:bg-slate-50/70">
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                             class="w-11 h-11 rounded-xl object-cover bg-[#F8F9FC] border border-slate-200 shrink-0">
                                        <div class="min-w-0">
                                            <p class="font-bold text-[#20243A] truncate max-w-[200px]">{{ $product->name }}</p>
                                            <p class="text-xs text-slate-400">{{ $product->seller_name ?: 'Mitra UMKM' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3.5">
                                    <span class="px-2.5 py-1 rounded-full bg-[#F1ECFB] text-[#6C4AB6] text-xs font-semibold">
                                        {{ $product->category?->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5 font-bold text-[#20243A]">
                                    {{ $product->formatted_price }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $product->stock > 10 ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td class="px-6 py-3.5 text-right">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="text-xs font-bold text-[#6C4AB6] hover:underline">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada data produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Ringkasan Kategori -->
        <div class="lg:col-span-4 bg-white rounded-3xl border border-slate-200/80 shadow-xs p-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-base font-extrabold text-[#20243A]">Sebaran Kategori</h2>
                <a href="{{ route('admin.categories.create') }}" class="text-xs font-bold text-[#6C4AB6] hover:underline">
                    + Kategori
                </a>
            </div>

            <div class="space-y-3.5">
                @forelse ($categoriesSummary as $cat)
                    <div class="flex items-center justify-between p-3.5 rounded-2xl bg-[#F8F9FC] border border-slate-200/60">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-9 h-9 rounded-xl bg-white text-[#6C4AB6] flex items-center justify-center border border-slate-200 shrink-0">
                                <x-category-icon :name="$cat->icon ?? 'tag'" class="w-4 h-4" />
                            </div>
                            <span class="text-sm font-bold text-[#20243A] truncate">{{ $cat->name }}</span>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-white text-xs font-extrabold text-[#FF9F43] border border-slate-200">
                            {{ $cat->products_count }} produk
                        </span>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada kategori.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
