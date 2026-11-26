@extends('layouts.app')

@section('title', 'Zahran Kopi — Marketplace Produk UMKM Lokal Modern')

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-[#6C4AB6] via-[#5939A3] to-[#20243A] text-white">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-[#FF9F43]/20 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-white/10 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7 space-y-6">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/12 border border-white/20 text-xs font-bold tracking-wide uppercase text-[#FF9F43]">
                        <span class="w-2 h-2 rounded-full bg-[#FF9F43]"></span>
                        Bangga Karya UMKM Indonesia
                    </span>

                    <h1 class="text-3xl sm:text-5xl lg:text-[52px] font-extrabold leading-[1.15] tracking-tight">
                        Temukan Produk <span class="text-[#FF9F43]">UMKM Lokal</span> Berkualitas dalam Satu Marketplace Modern
                    </h1>

                    <p class="text-base sm:text-lg text-white/85 max-w-2xl leading-relaxed">
                        <strong>Zahran Kopi</strong> adalah marketplace digital yang mempertemukan masyarakat luas dengan pelaku UMKM pilihan di seluruh Indonesia — mulai dari kopi Nusantara, kuliner autentik, batik tulis, kriya tangan, hingga produk herbal alami.
                    </p>

                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="{{ route('products.index') }}"
                           class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-[#FF9F43] hover:bg-[#E6872B] text-white font-bold text-sm shadow-lg shadow-orange-500/25 transition-all duration-200 hover:-translate-y-0.5">
                            Jelajahi Produk
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        <a href="{{ route('categories.index') }}"
                           class="inline-flex items-center gap-2 px-6 py-3.5 rounded-full bg-white/12 hover:bg-white/20 border border-white/25 text-white font-semibold text-sm backdrop-blur-sm transition-all">
                            Lihat Kategori
                        </a>
                    </div>

                    <!-- Mini Statistik -->
                    <div class="pt-6 grid grid-cols-3 gap-4 max-w-md border-t border-white/15">
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-[#FF9F43]">{{ $stats['products'] }}+</div>
                            <div class="text-xs text-white/75 font-medium">Produk UMKM</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-white">{{ $stats['categories'] }}</div>
                            <div class="text-xs text-white/75 font-medium">Kategori Pilihan</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-white">100%</div>
                            <div class="text-xs text-white/75 font-medium">Karya Lokal</div>
                        </div>
                    </div>
                </div>

                <!-- Showcase Kartu Hero -->
                <div class="lg:col-span-5">
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-5 shadow-2xl">
                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($featuredProducts->take(4) as $heroProduct)
                                <a href="{{ route('products.show', $heroProduct->slug) }}"
                                   class="group bg-white rounded-2xl p-3 text-[#20243A] shadow-md hover:-translate-y-1 transition-all duration-200">
                                    <div class="aspect-[4/3] rounded-xl overflow-hidden bg-[#F8F9FC] mb-2.5">
                                        <img src="{{ $heroProduct->image_url }}" alt="{{ $heroProduct->name }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                    <p class="text-xs font-bold line-clamp-1 group-hover:text-[#6C4AB6]">{{ $heroProduct->name }}</p>
                                    <p class="text-xs font-extrabold text-[#FF9F43] mt-0.5">{{ $heroProduct->formatted_price }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kategori Produk -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-[#FF9F43]">Eksplorasi Kategori</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#20243A] mt-1">Kategori Produk Pilihan</h2>
            </div>
            <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-[#6C4AB6] hover:text-[#57389D]">
                Semua Kategori
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}"
                   class="group bg-white rounded-3xl p-5 border border-slate-200/80 card-hover flex flex-col items-start">
                    <div class="w-12 h-12 rounded-2xl bg-[#F1ECFB] text-[#6C4AB6] group-hover:bg-[#6C4AB6] group-hover:text-white flex items-center justify-center transition-colors duration-200">
                        <x-category-icon :name="$category->icon ?? 'tag'" class="w-6 h-6" />
                    </div>
                    <h3 class="mt-4 text-sm font-bold text-[#20243A] group-hover:text-[#6C4AB6] transition-colors">
                        {{ $category->name }}
                    </h3>
                    <p class="mt-1 text-xs text-slate-500 font-medium">
                        {{ $category->products_count }} Produk tersedia
                    </p>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Produk Unggulan -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-[#FF9F43]">Rekomendasi Kurasi</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#20243A] mt-1">Produk Unggulan UMKM</h2>
            </div>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-[#6C4AB6] hover:text-[#57389D]">
                Lihat Semua Produk
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($featuredProducts as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full bg-white rounded-3xl p-10 text-center border border-slate-200">
                    <p class="text-slate-500">Belum ada produk unggulan yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Produk Terbaru -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-[#6C4AB6]">Katalog Terkini</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#20243A] mt-1">Produk Terbaru di Zahran Kopi</h2>
            </div>
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white border border-slate-200 hover:border-[#6C4AB6] text-xs font-bold text-[#20243A] hover:text-[#6C4AB6] transition-colors">
                Jelajahi Katalog Lengkap
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($latestProducts as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full bg-white rounded-3xl p-10 text-center border border-slate-200">
                    <p class="text-slate-500">Belum ada produk tersedia.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Keunggulan Berbelanja di Zahran Kopi -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20">
        <div class="bg-white rounded-[2rem] border border-slate-200/80 p-8 sm:p-12 shadow-sm">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-[#FF9F43]">Kenapa Memilih Kami</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#20243A] mt-2">Keunggulan Berbelanja di Zahran Kopi</h2>
                <p class="mt-3 text-sm sm:text-base text-slate-500">
                    Kami merancang pengalaman belanja yang ringkas dan transparan agar pembeli dan pelaku UMKM saling tumbuh bersama.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $advantages = [
                        [
                            'title' => 'Produk UMKM Terkurasi',
                            'desc' => 'Setiap produk melewati proses kurasi kualitas, kemasan, dan keaslian usaha lokal.',
                            'color' => 'bg-[#F1ECFB] text-[#6C4AB6]',
                        ],
                        [
                            'title' => 'Komunikasi Langsung',
                            'desc' => 'Terhubung langsung dengan penjual via WhatsApp untuk tanya stok, grosir, maupun kustomisasi.',
                            'color' => 'bg-[#FFF3E6] text-[#FF9F43]',
                        ],
                        [
                            'title' => 'Harga Transparan',
                            'desc' => 'Harga jujur langsung dari produsen UMKM tanpa biaya perantara yang memberatkan.',
                            'color' => 'bg-emerald-50 text-emerald-600',
                        ],
                        [
                            'title' => 'Dukung Ekonomi Daerah',
                            'desc' => 'Setiap transaksi Anda berkontribusi nyata menggerakkan perekonomian pengrajin lokal.',
                            'color' => 'bg-sky-50 text-sky-600',
                        ],
                    ];
                @endphp

                @foreach ($advantages as $idx => $adv)
                    <div class="rounded-3xl p-6 bg-[#F8F9FC] border border-slate-200/60">
                        <div class="w-11 h-11 rounded-2xl {{ $adv['color'] }} font-extrabold text-sm flex items-center justify-center mb-4">
                            0{{ $idx + 1 }}
                        </div>
                        <h3 class="text-base font-bold text-[#20243A]">{{ $adv['title'] }}</h3>
                        <p class="mt-2 text-sm text-slate-500 leading-relaxed">{{ $adv['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
