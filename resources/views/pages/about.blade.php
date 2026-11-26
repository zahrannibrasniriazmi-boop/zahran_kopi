@extends('layouts.app')

@section('title', 'Tentang Kami — @difMarket')

@section('content')
    <!-- Hero Tentang Kami -->
    <section class="bg-gradient-to-br from-[#6C4AB6] to-[#20243A] text-white py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <span class="inline-block px-4 py-1.5 rounded-full bg-white/15 text-[#FF9F43] text-xs font-bold uppercase tracking-widest">
                    Profil Usaha @difMarket
                </span>
                <h1 class="mt-4 text-3xl sm:text-5xl font-extrabold leading-tight">
                    Menghadirkan Karya Terbaik UMKM Indonesia ke Panggung Digital
                </h1>
                <p class="mt-5 text-base sm:text-lg text-white/85 leading-relaxed">
                    <strong>@difMarket</strong> adalah platform marketplace UMKM modern yang dibangun untuk mempermudah pelaku usaha mikro, kecil, dan menengah memasarkan produk unggulannya secara online dengan tampilan profesional dan akses langsung ke pembeli.
                </p>
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-md">
                <div class="w-12 h-12 rounded-2xl bg-[#F1ECFB] text-[#6C4AB6] flex items-center justify-center font-extrabold text-lg mb-5">
                    Visi
                </div>
                <h2 class="text-2xl font-extrabold text-[#20243A]">Visi Kami</h2>
                <p class="mt-3 text-slate-600 leading-relaxed">
                    Menjadi marketplace UMKM lokal terpercaya di Indonesia yang mendorong kemandirian ekonomi digital serta memperluas jangkauan produk karya anak bangsa hingga pasar nasional.
                </p>
            </div>

            <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-md">
                <div class="w-12 h-12 rounded-2xl bg-[#FFF3E6] text-[#FF9F43] flex items-center justify-center font-extrabold text-lg mb-5">
                    Misi
                </div>
                <h2 class="text-2xl font-extrabold text-[#20243A]">Misi Kami</h2>
                <ul class="mt-3 space-y-2.5 text-slate-600 text-sm sm:text-base">
                    <li class="flex items-start gap-2.5">
                        <span class="w-2 h-2 rounded-full bg-[#6C4AB6] mt-2 shrink-0"></span>
                        <span>Menyediakan etalase digital yang rapi, cepat, dan ramah perangkat seluler bagi pelaku UMKM.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="w-2 h-2 rounded-full bg-[#FF9F43] mt-2 shrink-0"></span>
                        <span>Mempermudah pembeli menemukan produk lokal autentik melalui pencarian dan kategorisasi yang jelas.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="w-2 h-2 rounded-full bg-[#6C4AB6] mt-2 shrink-0"></span>
                        <span>Menghubungkan pembeli dan penjual secara transparan lewat komunikasi WhatsApp tanpa proses rumit.</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Tujuan & Manfaat Marketplace untuk UMKM -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-5">
                <span class="text-xs font-bold uppercase tracking-widest text-[#FF9F43]">Tujuan &amp; Dampak</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#20243A] mt-2">
                    Manfaat Nyata @difMarket bagi Pelaku UMKM
                </h2>
                <p class="mt-4 text-slate-600 leading-relaxed">
                    Transformasi digital tidak harus rumit. @difMarket hadir membantu UMKM naik kelas dari pemasaran konvensional menjadi toko online yang terstruktur dan siap bersaing.
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('products.index') }}" class="px-6 py-3 rounded-full bg-[#6C4AB6] hover:bg-[#57389D] text-white text-sm font-bold transition-colors">
                        Lihat Produk UMKM
                    </a>
                    <a href="{{ route('contact.index') }}" class="px-6 py-3 rounded-full bg-white border border-slate-200 hover:border-[#6C4AB6] text-[#20243A] text-sm font-bold transition-colors">
                        Hubungi Tim Kami
                    </a>
                </div>
            </div>

            <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-5">
                @php
                    $benefits = [
                        ['title' => 'Jangkauan Pasar Lebih Luas', 'desc' => 'Produk tidak lagi terbatas di lingkungan sekitar, melainkan dapat diakses calon pembeli dari berbagai kota.'],
                        ['title' => 'Citra Brand Lebih Profesional', 'desc' => 'Setiap produk tampil dalam kartu katalog modern lengkap dengan foto, kategori, harga, dan stok.'],
                        ['title' => 'Pengelolaan Katalog Praktis', 'desc' => 'Admin dapat menambah, memperbarui harga/stok, dan mengelola foto produk secara terpusat.'],
                        ['title' => 'Transaksi Cepat & Personal', 'desc' => 'Calon pembeli dapat langsung berdiskusi dengan penjual via WhatsApp untuk konfirmasi pesanan.'],
                    ];
                @endphp

                @foreach ($benefits as $benefit)
                    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 card-hover">
                        <div class="w-9 h-9 rounded-xl bg-[#F1ECFB] text-[#6C4AB6] flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-[#20243A]">{{ $benefit['title'] }}</h3>
                        <p class="mt-2 text-sm text-slate-500 leading-relaxed">{{ $benefit['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
