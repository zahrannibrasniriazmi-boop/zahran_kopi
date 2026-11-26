@extends('layouts.app')

@section('title', 'Kategori Produk UMKM — @difMarket')

@section('content')
    <section class="bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <span class="text-xs font-bold uppercase tracking-widest text-[#FF9F43]">Direktori Kategori</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-[#20243A] mt-1">Kategori Produk @difMarket</h1>
            <p class="mt-2.5 text-sm sm:text-base text-slate-500 max-w-2xl">
                Pilih kategori untuk menelusuri produk-produk pilihan hasil karya pelaku UMKM Indonesia.
            </p>

            <!-- Grid Kartu Kategori -->
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($categories as $category)
                    <a href="{{ route('categories.show', $category->slug) }}"
                       class="group bg-[#F8F9FC] hover:bg-white rounded-3xl p-6 border border-slate-200/80 card-hover flex items-start gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-[#F1ECFB] text-[#6C4AB6] group-hover:bg-[#6C4AB6] group-hover:text-white flex items-center justify-center shrink-0 transition-colors">
                            <x-category-icon :name="$category->icon ?? 'tag'" class="w-7 h-7" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2">
                                <h2 class="text-base font-bold text-[#20243A] group-hover:text-[#6C4AB6] transition-colors truncate">
                                    {{ $category->name }}
                                </h2>
                                <span class="px-2.5 py-0.5 rounded-full bg-white text-xs font-bold text-[#FF9F43] border border-slate-200">
                                    {{ $category->products_count }}
                                </span>
                            </div>
                            <p class="mt-1.5 text-xs sm:text-sm text-slate-500 line-clamp-2 leading-relaxed">
                                {{ $category->description ?: 'Kumpulan produk unggulan pada kategori ' . $category->name . '.' }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Daftar Produk Berdasarkan Kategori -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 space-y-16">
        @foreach ($categories as $category)
            @if ($category->products->isNotEmpty())
                <div>
                    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6">
                        <div class="flex items-center gap-3.5">
                            <div class="w-11 h-11 rounded-2xl bg-[#6C4AB6] text-white flex items-center justify-center shadow-sm">
                                <x-category-icon :name="$category->icon ?? 'tag'" class="w-5 h-5" />
                            </div>
                            <div>
                                <h2 class="text-2xl font-extrabold text-[#20243A]">{{ $category->name }}</h2>
                                <p class="text-xs sm:text-sm text-slate-500">{{ $category->products_count }} produk terdaftar</p>
                            </div>
                        </div>

                        <a href="{{ route('categories.show', $category->slug) }}"
                           class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full bg-white border border-slate-200 hover:border-[#6C4AB6] text-xs font-bold text-[#6C4AB6] transition-colors self-start sm:self-auto">
                            Lihat Semua di {{ $category->name }}
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($category->products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </section>
@endsection
