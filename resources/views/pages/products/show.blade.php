@extends('layouts.app')

@section('title', $product->name . ' — Zahran Kopi')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8 pb-24 lg:pb-0">
        <!-- Breadcrumb -->
        <nav class="flex flex-wrap items-center gap-2 text-xs font-semibold text-slate-500 mb-5" aria-label="Breadcrumb">
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
            <span class="text-[#20243A] truncate max-w-[200px] sm:max-w-xs">{{ $product->name }}</span>
        </nav>

        <!-- Kontainer Detail Produk -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden p-5 sm:p-8 lg:p-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
                <!-- Foto Produk Besar -->
                <div class="lg:col-span-6">
                    <div class="relative aspect-[4/3] rounded-2xl overflow-hidden bg-slate-100 border border-slate-200/70">
                        <img src="{{ $product->image_url }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover">
                        @if ($product->is_featured)
                            <span class="absolute top-3.5 left-3.5 px-3 py-1 rounded-full bg-[#FF9F43] text-white text-xs font-bold shadow-xs">
                                Produk Unggulan
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Informasi Produk -->
                <div class="lg:col-span-6 flex flex-col">
                    <div class="flex flex-wrap items-center gap-2">
                        @if ($product->category)
                            <a href="{{ route('categories.show', $product->category->slug) }}"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-[#F1ECFB] text-[#6C4AB6] text-xs font-bold hover:bg-[#6C4AB6] hover:text-white transition-colors">
                                <x-category-icon :name="$product->category->icon ?? 'tag'" class="w-3.5 h-3.5" />
                                {{ $product->category->name }}
                            </a>
                        @endif

                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold tabular-nums {{ $product->stock > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                            <span class="w-2 h-2 rounded-full {{ $product->stock > 0 ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                            {{ $product->stock > 0 ? 'Tersedia (' . $product->stock . ' unit)' : 'Stok Sedang Habis' }}
                        </span>
                    </div>

                    <h1 class="mt-4 text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#20243A] leading-tight">
                        {{ $product->name }}
                    </h1>

                    @if ($product->seller_name)
                        <div class="mt-2.5 flex items-center gap-2 text-sm text-slate-500">
                            <span class="font-medium">Penjual UMKM:</span>
                            <span class="font-bold text-[#20243A]">{{ $product->seller_name }}</span>
                        </div>
                    @endif

                    <!-- Panel Harga & Stepper Jumlah -->
                    <div class="mt-6 p-4 sm:p-5 rounded-2xl bg-[#F8F9FC] border border-slate-200/80 flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Harga Satuan</span>
                            <div class="text-2xl sm:text-3xl font-extrabold text-[#6C4AB6] mt-0.5 tabular-nums">
                                {{ $product->formatted_price }}
                            </div>
                            <p class="text-xs text-slate-500 mt-1 tabular-nums">
                                Perkiraan subtotal: <span id="wa-subtotal" class="font-bold text-[#20243A]">{{ $product->formatted_price }}</span>
                            </p>
                        </div>

                        <div class="flex flex-col items-end gap-1.5">
                            <label for="wa-qty-input" class="text-xs font-semibold text-slate-500">Jumlah Pesanan</label>
                            <div class="inline-flex items-center rounded-xl border border-slate-200 bg-white overflow-hidden">
                                <button type="button"
                                        data-qty-minus
                                        aria-label="Kurangi jumlah"
                                        class="w-11 h-11 flex items-center justify-center text-[#20243A] hover:bg-slate-100 font-bold text-lg cursor-pointer">
                                    &minus;
                                </button>
                                <input id="wa-qty-input"
                                       type="number"
                                       min="1"
                                       max="{{ max(1, $product->stock) }}"
                                       value="1"
                                       data-unit-price="{{ (int) $product->price }}"
                                       class="w-14 h-11 border-x border-slate-200 text-center text-sm font-bold tabular-nums focus:outline-none">
                                <button type="button"
                                        data-qty-plus
                                        aria-label="Tambah jumlah"
                                        class="w-11 h-11 flex items-center justify-center text-[#20243A] hover:bg-slate-100 font-bold text-lg cursor-pointer">
                                    +
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Deskripsi Produk</h2>
                        <div class="text-sm sm:text-base text-slate-600 leading-relaxed whitespace-pre-line">
                            {{ $product->description }}
                        </div>
                    </div>

                    <!-- Tombol Aksi Desktop & Tablet -->
                    <div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap items-center gap-3">
                        <a id="wa-order-link"
                           data-wa-order-link
                           href="{{ $product->whatsapp_url }}"
                           data-phone="{{ preg_replace('/[^0-9]/', '', $product->seller_whatsapp ?: '6281234567890') }}"
                           data-product="{{ $product->name }}"
                           data-price="{{ $product->formatted_price }}"
                           data-seller="{{ $product->seller_name ?: 'Penjual UMKM' }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center justify-center gap-2.5 min-h-[48px] px-7 py-3 rounded-xl bg-[#FF9F43] hover:bg-[#E6872B] text-white font-bold text-sm shadow-sm transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2a10 10 0 00-8.6 15.1L2 22l5.1-1.3A10 10 0 1012 2zm0 18a8 8 0 01-4.1-1.1l-.3-.2-3 .8.8-2.9-.2-.3A8 8 0 1112 20zm4.4-5.9c-.2-.1-1.4-.7-1.6-.8-.2-.1-.4-.1-.6.1-.2.2-.7.8-.8 1-.2.2-.3.2-.5.1a6.6 6.6 0 01-3.3-2.9c-.2-.4.2-.4.6-1.2.1-.2 0-.4 0-.5-.1-.1-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.2.3-.9.9-.9 2.2s1 2.6 1.1 2.8c.1.2 1.9 3 4.7 4.2.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.4-.6 1.6-1.2.2-.6.2-1.1.1-1.2 0-.1-.2-.2-.4-.3z"/>
                            </svg>
                            Hubungi Penjual via WhatsApp
                        </a>

                        <a href="{{ route('products.index') }}"
                           class="inline-flex items-center justify-center gap-2 min-h-[48px] px-6 py-3 rounded-xl bg-[#F1ECFB] hover:bg-[#6C4AB6] text-[#6C4AB6] hover:text-white font-bold text-sm transition-colors">
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
            <div class="mt-14">
                <div class="flex items-end justify-between mb-6">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#FF9F43]">Rekomendasi Serupa</span>
                        <h2 class="text-xl sm:text-2xl font-extrabold text-[#20243A] mt-1">Produk Lainnya di Kategori Ini</h2>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
                    @foreach ($relatedProducts as $related)
                        <x-product-card :product="$related" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Sticky Bottom Bar Khusus Mobile -->
    <div class="lg:hidden fixed bottom-0 inset-x-0 z-30 bg-white/95 backdrop-blur-md border-t border-slate-200 px-4 py-3 shadow-lg">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-3">
            <div class="min-w-0">
                <span class="block text-[11px] font-medium text-slate-400">Harga Satuan</span>
                <span class="text-base font-extrabold text-[#6C4AB6] tabular-nums truncate">{{ $product->formatted_price }}</span>
            </div>
            <a data-wa-order-link
               href="{{ $product->whatsapp_url }}"
               data-phone="{{ preg_replace('/[^0-9]/', '', $product->seller_whatsapp ?: '6281234567890') }}"
               data-product="{{ $product->name }}"
               data-price="{{ $product->formatted_price }}"
               data-seller="{{ $product->seller_name ?: 'Penjual UMKM' }}"
               target="_blank"
               rel="noopener noreferrer"
               class="inline-flex items-center justify-center gap-2 min-h-[44px] px-5 py-2.5 rounded-xl bg-[#FF9F43] hover:bg-[#E6872B] text-white font-bold text-sm shrink-0">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2a10 10 0 00-8.6 15.1L2 22l5.1-1.3A10 10 0 1012 2zm0 18a8 8 0 01-4.1-1.1l-.3-.2-3 .8.8-2.9-.2-.3A8 8 0 1112 20zm4.4-5.9c-.2-.1-1.4-.7-1.6-.8-.2-.1-.4-.1-.6.1-.2.2-.7.8-.8 1-.2.2-.3.2-.5.1a6.6 6.6 0 01-3.3-2.9c-.2-.4.2-.4.6-1.2.1-.2 0-.4 0-.5-.1-.1-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.2.3-.9.9-.9 2.2s1 2.6 1.1 2.8c.1.2 1.9 3 4.7 4.2.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.4-.6 1.6-1.2.2-.6.2-1.1.1-1.2 0-.1-.2-.2-.4-.3z"/>
                </svg>
                Pesan WhatsApp
            </a>
        </div>
    </div>
@endsection
