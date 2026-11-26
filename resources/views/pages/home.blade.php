@extends('layouts.app')

@section('title', 'Zahran Kopi — Marketplace Produk UMKM Lokal Indonesia')

@section('content')
    <!-- Hero Section: Editorial & Fokus Pencarian Lintas Perangkat -->
    <section class="relative bg-[#20243A] text-white border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
                <div class="lg:col-span-7 space-y-6">
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/15 text-xs font-bold tracking-wide uppercase text-[#FF9F43]">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#FF9F43]"></span>
                        Karya UMKM Indonesia
                    </span>

                    <h1 class="text-3xl sm:text-4xl lg:text-[48px] font-extrabold leading-[1.14] tracking-tight">
                        Kurasi Produk <span class="text-[#FF9F43]">UMKM Lokal</span> Langsung dari Pelaku Usaha
                    </h1>

                    <p class="text-base sm:text-lg text-slate-300 max-w-xl leading-relaxed">
                        <strong>Zahran Kopi</strong> menghubungkan Anda dengan kopi Nusantara, kuliner rumahan, batik tulis, kriya tangan, dan herbal alami — pesan langsung ke penjual tanpa perantara.
                    </p>

                    <!-- Pencarian Cepat di Hero (Nyaman di HP & Laptop) -->
                    <form action="{{ route('products.index') }}" method="GET" class="max-w-xl">
                        <div class="flex flex-col sm:flex-row gap-2.5 p-1.5 rounded-2xl bg-white/10 border border-white/15">
                            <div class="relative flex-1">
                                <svg class="w-5 h-5 text-slate-300 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                                </svg>
                                <input type="text"
                                       name="q"
                                       placeholder="Cari kopi arabika, batik, kerajinan..."
                                       class="w-full min-h-[44px] pl-11 pr-4 py-2.5 rounded-xl bg-transparent text-white placeholder:text-slate-300 text-sm focus:outline-none">
                            </div>
                            <button type="submit"
                                    class="min-h-[44px] px-6 py-2.5 rounded-xl bg-[#FF9F43] hover:bg-[#E6872B] text-white font-bold text-sm transition-colors cursor-pointer shrink-0">
                                Cari Produk
                            </button>
                        </div>
                    </form>

                    <div class="flex flex-wrap items-center gap-3 pt-1">
                        <a href="{{ route('products.index') }}"
                           class="inline-flex items-center justify-center gap-2 min-h-[44px] px-6 py-2.5 rounded-xl bg-[#6C4AB6] hover:bg-[#57389D] text-white font-bold text-sm transition-colors">
                            Jelajahi Semua Produk
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        <a href="{{ route('categories.index') }}"
                           class="inline-flex items-center justify-center min-h-[44px] px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/15 border border-white/15 text-white font-semibold text-sm transition-colors">
                            Lihat Kategori
                        </a>
                    </div>

                    <!-- Statistik Ringkas -->
                    <div class="pt-5 grid grid-cols-3 gap-4 max-w-md border-t border-white/15 tabular-nums">
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-[#FF9F43]">{{ $stats['products'] }}+</div>
                            <div class="text-xs text-slate-300 font-medium">Produk Terkurasi</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-white">{{ $stats['categories'] }}</div>
                            <div class="text-xs text-slate-300 font-medium">Kategori Usaha</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-white">100%</div>
                            <div class="text-xs text-slate-300 font-medium">Karya Lokal</div>
                        </div>
                    </div>
                </div>

                <!-- Showcase Produk Pilihan -->
                <div class="lg:col-span-5">
                    <div class="bg-white/5 border border-white/15 rounded-2xl p-4 sm:p-5">
                        <div class="flex items-center justify-between mb-3.5">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-300">Pilihan Editor</span>
                            <a href="{{ route('products.index') }}" class="text-xs font-semibold text-[#FF9F43] hover:underline">
                                Lihat katalog &rarr;
                            </a>
                        </div>
                        <div class="grid grid-cols-2 gap-3.5">
                            @foreach ($featuredProducts->take(4) as $heroProduct)
                                <a href="{{ route('products.show', $heroProduct->slug) }}"
                                   class="group bg-white rounded-xl p-2.5 text-[#20243A] border border-transparent hover:border-[#FF9F43] transition-colors">
                                    <div class="aspect-[4/3] rounded-lg overflow-hidden bg-slate-100 mb-2">
                                        <img src="{{ $heroProduct->image_url }}" alt="{{ $heroProduct->name }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                    <p class="text-xs font-bold line-clamp-1 group-hover:text-[#6C4AB6]">{{ $heroProduct->name }}</p>
                                    <p class="text-xs font-extrabold text-[#6C4AB6] mt-0.5 tabular-nums">{{ $heroProduct->formatted_price }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kategori Produk (Scroll Horizontal di HP, Grid di Desktop) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 sm:pt-16">
        <div class="flex items-end justify-between gap-4 mb-6">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-[#FF9F43]">Kategori</span>
                <h2 class="text-xl sm:text-2xl font-extrabold text-[#20243A] mt-1">Telusuri Berdasarkan Kategori</h2>
            </div>
            <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-1 text-sm font-bold text-[#6C4AB6] hover:text-[#57389D] shrink-0">
                Semua
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="flex sm:grid sm:grid-cols-3 lg:grid-cols-5 gap-3.5 sm:gap-4 overflow-x-auto snap-x no-scrollbar pb-2 sm:pb-0">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}"
                   class="group min-w-[165px] sm:min-w-0 snap-start bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 card-hover flex flex-col items-start shrink-0">
                    <div class="w-11 h-11 rounded-xl bg-[#F1ECFB] text-[#6C4AB6] group-hover:bg-[#6C4AB6] group-hover:text-white flex items-center justify-center transition-colors duration-200">
                        <x-category-icon :name="$category->icon ?? 'tag'" class="w-5 h-5" />
                    </div>
                    <h3 class="mt-3.5 text-sm font-bold text-[#20243A] group-hover:text-[#6C4AB6] transition-colors">
                        {{ $category->name }}
                    </h3>
                    <p class="mt-0.5 text-xs text-slate-500 font-medium tabular-nums">
                        {{ $category->products_count }} produk
                    </p>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Produk Unggulan -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 sm:pt-16">
        <div class="flex items-end justify-between gap-4 mb-6">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-[#FF9F43]">Rekomendasi Kurasi</span>
                <h2 class="text-xl sm:text-2xl font-extrabold text-[#20243A] mt-1">Produk Unggulan UMKM</h2>
            </div>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1 text-sm font-bold text-[#6C4AB6] hover:text-[#57389D] shrink-0">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
            @forelse ($featuredProducts as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full bg-white rounded-2xl p-10 text-center border border-slate-200">
                    <p class="text-slate-500">Belum ada produk unggulan yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Produk Terbaru -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 sm:pt-16">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-[#6C4AB6]">Katalog Terkini</span>
                <h2 class="text-xl sm:text-2xl font-extrabold text-[#20243A] mt-1">Produk Terbaru di Zahran Kopi</h2>
            </div>
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center justify-center min-h-[40px] px-4 py-2 rounded-xl bg-white border border-slate-200 hover:border-[#6C4AB6] text-xs font-bold text-[#20243A] hover:text-[#6C4AB6] transition-colors self-start sm:self-auto">
                Jelajahi Katalog Lengkap
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
            @forelse ($latestProducts as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full bg-white rounded-2xl p-10 text-center border border-slate-200">
                    <p class="text-slate-500">Belum ada produk tersedia.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Keunggulan Berbelanja di Zahran Kopi -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 sm:pt-20">
        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-10">
            <div class="max-w-2xl mb-8">
                <span class="text-xs font-bold uppercase tracking-widest text-[#FF9F43]">Nilai Kami</span>
                <h2 class="text-xl sm:text-2xl font-extrabold text-[#20243A] mt-1">Kenapa Berbelanja di Zahran Kopi</h2>
                <p class="mt-2 text-sm sm:text-base text-slate-500">
                    Transaksi langsung yang ringkas agar pembeli mendapat produk autentik dan pelaku UMKM bertumbuh.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @php
                    $advantages = [
                        [
                            'title' => 'Produk Terkurasi',
                            'desc' => 'Setiap produk melalui seleksi kualitas, kemasan, dan keaslian usaha lokal.',
                            'color' => 'bg-[#F1ECFB] text-[#6C4AB6]',
                            'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                        ],
                        [
                            'title' => 'Langsung ke Penjual',
                            'desc' => 'Tanya stok, grosir, atau kustomisasi langsung lewat WhatsApp pemilik usaha.',
                            'color' => 'bg-[#FFF3E6] text-[#FF9F43]',
                            'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z',
                        ],
                        [
                            'title' => 'Harga Transparan',
                            'desc' => 'Harga jujur dari produsen UMKM tanpa biaya perantara tambahan.',
                            'color' => 'bg-emerald-50 text-emerald-600',
                            'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                        ],
                        [
                            'title' => 'Dukung Ekonomi Lokal',
                            'desc' => 'Setiap pesanan Anda membantu menggerakkan pengrajin dan petani daerah.',
                            'color' => 'bg-sky-50 text-sky-600',
                            'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064',
                        ],
                    ];
                @endphp

                @foreach ($advantages as $adv)
                    <div class="rounded-xl p-5 bg-[#F8F9FC] border border-slate-200/70">
                        <div class="w-10 h-10 rounded-xl {{ $adv['color'] }} flex items-center justify-center mb-3.5">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $adv['icon'] }}"/>
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-[#20243A]">{{ $adv['title'] }}</h3>
                        <p class="mt-1.5 text-sm text-slate-500 leading-relaxed">{{ $adv['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
