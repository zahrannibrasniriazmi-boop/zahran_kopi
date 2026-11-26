@extends('layouts.app')

@section('title', 'Kategori ' . $category->name . ' — @difMarket')

@section('content')
    <section class="bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-[#6C4AB6] text-white flex items-center justify-center shrink-0 shadow-sm">
                        <x-category-icon :name="$category->icon ?? 'tag'" class="w-7 h-7" />
                    </div>
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#FF9F43]">Kategori Produk</span>
                        <h1 class="text-3xl font-extrabold text-[#20243A] mt-0.5">{{ $category->name }}</h1>
                        @if ($category->description)
                            <p class="mt-2 text-sm text-slate-500 max-w-2xl">{{ $category->description }}</p>
                        @endif
                    </div>
                </div>

                <a href="{{ route('categories.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#F1ECFB] text-[#6C4AB6] text-xs font-bold hover:bg-[#6C4AB6] hover:text-white transition-colors self-start md:self-auto">
                    Semua Kategori
                </a>
            </div>

            <!-- Switcher Kategori -->
            <div class="mt-6 flex flex-wrap gap-2">
                @foreach ($categories as $item)
                    <a href="{{ route('categories.show', $item->slug) }}"
                       class="px-4 py-1.5 rounded-full text-xs font-semibold transition-colors {{ $item->id === $category->id ? 'bg-[#6C4AB6] text-white' : 'bg-[#F8F9FC] text-slate-600 hover:bg-[#F1ECFB] hover:text-[#6C4AB6]' }}">
                        {{ $item->name }} ({{ $item->products_count }})
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
        @if ($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="mt-10">
                {{ $products->links() }}
            </div>
        @else
            <div class="bg-white rounded-3xl border border-slate-200 p-12 text-center max-w-xl mx-auto">
                <h2 class="text-xl font-bold text-[#20243A]">Belum Ada Produk di Kategori Ini</h2>
                <p class="mt-2 text-sm text-slate-500">
                    Produk UMKM untuk kategori {{ $category->name }} sedang dalam proses penambahan.
                </p>
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center gap-2 mt-6 px-6 py-3 rounded-full bg-[#6C4AB6] text-white text-sm font-bold">
                    Jelajahi Semua Produk
                </a>
            </div>
        @endif
    </section>
@endsection
