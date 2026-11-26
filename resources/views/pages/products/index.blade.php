@extends('layouts.app')

@section('title', 'Katalog Produk UMKM — Zahran Kopi')

@section('content')
    <section class="bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-[#FF9F43]">Katalog Zahran Kopi</span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-[#20243A] mt-1">
                        {{ $activeCategory ? 'Produk Kategori: ' . $activeCategory->name : 'Jelajahi Produk UMKM' }}
                    </h1>
                    <p class="mt-1.5 text-sm text-slate-500 max-w-xl">
                        Temukan beragam produk unggulan karya UMKM Indonesia. Gunakan pencarian atau filter kategori di bawah ini.
                    </p>
                </div>
                <div class="text-sm font-semibold text-slate-600 bg-[#F8F9FC] px-4 py-2 rounded-xl border border-slate-200 self-start md:self-auto tabular-nums">
                    Menampilkan <span class="text-[#6C4AB6] font-bold">{{ $products->total() }}</span> produk
                </div>
            </div>

            <!-- Bar Pencarian & Filter -->
            <form action="{{ route('products.index') }}" method="GET" class="mt-6 grid grid-cols-1 md:grid-cols-12 gap-3">
                <div class="md:col-span-5 relative">
                    <svg class="w-5 h-5 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                    </svg>
                    <input type="text"
                           name="q"
                           value="{{ $search }}"
                           placeholder="Cari nama produk, deskripsi, atau nama UMKM..."
                           class="w-full min-h-[44px] pl-11 pr-4 py-2.5 rounded-xl bg-[#F8F9FC] border border-slate-200 text-sm focus:border-[#6C4AB6] focus:bg-white transition-colors">
                </div>

                <div class="md:col-span-3">
                    <select name="kategori"
                            class="w-full min-h-[44px] px-4 py-2.5 rounded-xl bg-[#F8F9FC] border border-slate-200 text-sm focus:border-[#6C4AB6] focus:bg-white transition-colors">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->slug }}" @selected($categorySlug === $cat->slug)>
                                {{ $cat->name }} ({{ $cat->products_count }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <select name="urutkan"
                            class="w-full min-h-[44px] px-4 py-2.5 rounded-xl bg-[#F8F9FC] border border-slate-200 text-sm focus:border-[#6C4AB6] focus:bg-white transition-colors">
                        <option value="terbaru" @selected($sort === 'terbaru')>Terbaru</option>
                        <option value="termurah" @selected($sort === 'termurah')>Harga Terendah</option>
                        <option value="termahal" @selected($sort === 'termahal')>Harga Tertinggi</option>
                    </select>
                </div>

                <div class="md:col-span-2 flex gap-2">
                    <button type="submit"
                            class="flex-1 min-h-[44px] px-5 py-2.5 rounded-xl bg-[#6C4AB6] hover:bg-[#57389D] text-white text-sm font-bold shadow-xs transition-colors cursor-pointer">
                        Terapkan
                    </button>
                    @if ($search !== '' || $categorySlug !== '' || $sort !== 'terbaru')
                        <a href="{{ route('products.index') }}"
                           title="Reset filter"
                           class="inline-flex items-center justify-center min-h-[44px] px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-[#20243A] text-sm font-semibold transition-colors">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            <!-- Pil Filter Kategori Cepat (Scrollable di HP) -->
            <div class="mt-4 flex items-center gap-2 overflow-x-auto no-scrollbar pb-1">
                <a href="{{ route('products.index', array_filter(['q' => $search, 'urutkan' => $sort !== 'terbaru' ? $sort : null])) }}"
                   class="inline-flex items-center min-h-[36px] px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-colors {{ $categorySlug === '' ? 'bg-[#6C4AB6] text-white' : 'bg-[#F8F9FC] text-slate-600 hover:bg-[#F1ECFB] hover:text-[#6C4AB6]' }}">
                    Semua
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('products.index', array_filter(['kategori' => $cat->slug, 'q' => $search, 'urutkan' => $sort !== 'terbaru' ? $sort : null])) }}"
                       class="inline-flex items-center min-h-[36px] px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-colors {{ $categorySlug === $cat->slug ? 'bg-[#6C4AB6] text-white' : 'bg-[#F8F9FC] text-slate-600 hover:bg-[#F1ECFB] hover:text-[#6C4AB6]' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 sm:pt-10">
        @if ($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="mt-10">
                {{ $products->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl border border-slate-200 p-10 sm:p-12 text-center max-w-xl mx-auto my-8">
                <div class="w-14 h-14 rounded-2xl bg-[#F1ECFB] text-[#6C4AB6] flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-[#20243A]">Produk Tidak Ditemukan</h2>
                <p class="mt-2 text-sm text-slate-500">
                    Maaf, kami tidak menemukan produk yang sesuai dengan kata kunci atau kategori yang Anda pilih.
                </p>
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center justify-center gap-2 min-h-[44px] mt-6 px-6 py-2.5 rounded-xl bg-[#6C4AB6] hover:bg-[#57389D] text-white text-sm font-bold">
                    Lihat Semua Produk
                </a>
            </div>
        @endif
    </section>
@endsection
