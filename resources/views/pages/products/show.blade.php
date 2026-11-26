@extends('layouts.app')

@section('title', $product->name . ' — @difMarket')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <!-- Breadcrumb -->
        <nav class="flex flex-wrap items-center gap-2 text-xs font-semibold text-slate-500 mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#6C4AB6]">Beranda</a>
            <span>/</span>
            <a href="{{ route('products.index') }}" class="hover:text-[#6C4AB6]">Produk</a>
            @if ($product->category)
                <span>/</span>
                <a href="{{ route('categories.show', $product->category->slug) }}" class="hover:text-[#6C4AB6]">
                    {{ $product->category->name }}
                </a>
            @endif
            <span>/</span>
            <span class="text-[#20243A] truncate max-w-xs">{{ $product->name }}</span>
        </nav>

        <!-- Kontainer Detail Produk -->
        <div class="bg-white rounded-[2rem] border border-slate-200/80 shadow-sm overflow-hidden p-6 sm:p-8 lg:p-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                <!-- Foto Produk Besar -->
                <div class="lg:col-span-6">
                    <div class="relative aspect-[4/3] rounded-3xl overflow-hidden bg-[#F8F9FC] border border-slate-200/70 shadow-inner">
                        <img src="{{ $product->image_url }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover">
                        @if ($product->is_featured)
                            <span class="absolute top-4 left-4 px-3.5 py-1.5 rounded-full bg-[#FF9F43] text-white text-xs font-bold shadow">
                                Produk Unggulan
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Informasi Produk -->
                <div class="lg:col-span-6 flex flex-col">
                    <div class="flex flex-wrap items-center gap-2.5">
                        @if ($product->category)
                            <a href="{{ route('categories.show', $product->category->slug) }}"
                               class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-[#F1ECFB] text-[#6C4AB6] text-xs font-bold hover:bg-[#6C4AB6] hover:text-white transition-colors">
                                <x-category-icon :name="$product->category->icon ?? 'tag'" class="w-3.5 h-3.5" />
                                {{ $product->category->name }}
                            </a>
                        @endif

                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold {{ $product->stock > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                            <span class="w-2 h-2 rounded-full {{ $product->stock > 0 ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                            {{ $product->stock > 0 ? 'Tersedia (' . $product->stock . ' unit)' : 'Stok Sedang Habis' }}
                        </span>
                    </div>

                    <h1 class="mt-4 text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#20243A] leading-tight">
                        {{ $product->name }}
                    </h1>

                    @if ($product->seller_name)
                        <div class="mt-3 flex items-center gap-2 text-sm text-slate-500">
                            <span class="font-medium">Penjual UMKM:</span>
                            <span class="font-bold text-[#20243A]">{{ $product->seller_name }}</span>
                        </div>
                    @endif

                    <div class="mt-6 p-5 rounded-2xl bg-[#F8F9FC] border border-slate-200/70 flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Harga Satuan</span>
                            <div class="text-3xl font-extrabold text-[#6C4AB6] mt-0.5">
                                {{ $product->formatted_price }}
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <label for="wa-qty-input" class="text-xs font-semibold text-slate-500">Jumlah:</label>
                            <input id="wa-qty-input"
                                   type="number"
                                   min="1"
                                   max="{{ max(1, $product->stock) }}"
                                   value="1"
                                   class="w-20 px-3 py-2 rounded-xl border border-slate-200 bg-white text-center text-sm font-bold focus:outline-none focus:border-[#6C4AB6]">
                        </div>
                    </div>

                    <div class="mt-6">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-[#20243A] mb-2.5">Deskripsi Produk</h2>
                        <div class="text-sm sm:text-base text-slate-600 leading-relaxed whitespace-pre-line">
                            {{ $product->description }}
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap items-center gap-3.5">
                        <a id="wa-order-link"
                           href="{{ $product->whatsapp_url }}"
                           data-phone="{{ preg_replace('/[^0-9]/', '', $product->seller_whatsapp ?: '6281234567890') }}"
                           data-product="{{ $product->name }}"
                           data-price="{{ $product->formatted_price }}"
                           data-seller="{{ $product->seller_name ?: 'Penjual UMKM' }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-full bg-[#FF9F43] hover:bg-[#E6872B] text-white font-bold text-sm shadow-lg shadow-orange-500/20 transition-all duration-200 hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2a10 10 0 00-8.6 15.1L2 22l5.1-1.3A10 10 0 1012 2zm0 18a8 8 0 01-4.1-1.1l-.3-.2-3 .8.8-2.9-.2-.3A8 8 0 1112 20zm4.4-5.9c-.2-.1-1.4-.7-1.6-.8-.2-.1-.4-.1-.6.1-.2.2-.7.8-.8 1-.2.2-.3.2-.5.1a6.6 6.6 0 01-3.3-2.9c-.2-.4.2-.4.6-1.2.1-.2 0-.4 0-.5-.1-.1-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.2.3-.9.9-.9 2.2s1 2.6 1.1 2.8c.1.2 1.9 3 4.7 4.2.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.4-.6 1.6-1.2.2-.6.2-1.1.1-1.2 0-.1-.2-.2-.4-.3z"/>
                            </svg>
                            Hubungi Penjual via WhatsApp
                        </a>

                        <a href="{{ route('products.index') }}"
                           class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-full bg-[#F1ECFB] hover:bg-[#6C4AB6] text-[#6C4AB6] hover:text-white font-bold text-sm transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Kembali ke Daftar Produk
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produk Terkait -->
        @if ($relatedProducts->isNotEmpty())
            <div class="mt-16">
                <div class="flex items-end justify-between mb-6">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#FF9F43]">Rekomendasi Serupa</span>
                        <h2 class="text-2xl font-extrabold text-[#20243A] mt-1">Produk Lainnya di Kategori Ini</h2>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($relatedProducts as $related)
                        <x-product-card :product="$related" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
