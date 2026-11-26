<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#6C4AB6">
    <meta name="description" content="@yield('meta_description', 'Zahran Kopi - Marketplace produk UMKM lokal Indonesia berkualitas dan terpercaya.')">
    <title>@yield('title', 'Zahran Kopi — Marketplace UMKM Indonesia')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-[#F8F9FC] text-[#20243A]">
    <!-- Navbar -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-18 py-3">
                <a href="{{ route('home') }}" class="focus:outline-none">
                    <x-brand-logo />
                </a>

                <!-- Menu Desktop -->
                <nav class="hidden md:flex items-center gap-1 lg:gap-2" aria-label="Navigasi Utama">
                    @php
                        $navItems = [
                            ['label' => 'Beranda', 'route' => 'home', 'active' => request()->routeIs('home')],
                            ['label' => 'Produk', 'route' => 'products.index', 'active' => request()->routeIs('products.*')],
                            ['label' => 'Kategori', 'route' => 'categories.index', 'active' => request()->routeIs('categories.*')],
                            ['label' => 'Tentang Kami', 'route' => 'about', 'active' => request()->routeIs('about')],
                            ['label' => 'Kontak', 'route' => 'contact.index', 'active' => request()->routeIs('contact.*')],
                        ];
                    @endphp

                    @foreach ($navItems as $item)
                        <a href="{{ route($item['route']) }}"
                           class="px-4 py-2 rounded-full text-sm font-semibold transition-all duration-200 {{ $item['active'] ? 'bg-[#F1ECFB] text-[#6C4AB6]' : 'text-[#20243A]/80 hover:text-[#6C4AB6] hover:bg-slate-100/80' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                <!-- Aksi Kanan Desktop -->
                <div class="hidden md:flex items-center gap-3">
                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-semibold border border-slate-200 text-[#20243A] hover:border-[#6C4AB6] hover:text-[#6C4AB6] transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                        </svg>
                        Cari Produk
                    </a>
                    @auth
                        @if (auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}"
                               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-bold bg-[#6C4AB6] text-white hover:bg-[#57389D] shadow-sm transition-all">
                                Dashboard Admin
                            </a>
                        @endif
                    @else
                        <a href="{{ route('admin.login') }}"
                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-bold bg-[#FF9F43] text-white hover:bg-[#E6872B] shadow-sm transition-all">
                            Login Admin
                        </a>
                    @endauth
                </div>

                <!-- Tombol Menu Mobile -->
                <div class="flex md:hidden items-center gap-2">
                    <a href="{{ route('products.index') }}"
                       aria-label="Cari Produk"
                       class="inline-flex items-center justify-center w-11 h-11 rounded-xl text-[#20243A] hover:bg-slate-100">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                        </svg>
                    </a>
                    <button type="button"
                            data-toggle-target="mobile-menu"
                            aria-expanded="false"
                            aria-label="Buka menu navigasi"
                            class="inline-flex items-center justify-center w-11 h-11 rounded-xl text-[#20243A] hover:bg-slate-100">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Menu Mobile -->
            <div id="mobile-menu" class="hidden md:hidden pb-5 pt-3 border-t border-slate-100 space-y-2">
                <form action="{{ route('products.index') }}" method="GET" class="pb-2">
                    <div class="relative">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                        </svg>
                        <input type="text"
                               name="q"
                               placeholder="Cari kopi, kuliner, atau kriya UMKM..."
                               class="w-full min-h-[44px] pl-10 pr-4 py-2.5 rounded-xl bg-[#F8F9FC] border border-slate-200 text-sm focus:bg-white focus:border-[#6C4AB6]">
                    </div>
                </form>

                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center min-h-[44px] px-4 py-2.5 rounded-xl text-sm font-semibold {{ $item['active'] ? 'bg-[#F1ECFB] text-[#6C4AB6]' : 'text-[#20243A] hover:bg-slate-50' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
                <div class="pt-3 border-t border-slate-100 flex items-center gap-2">
                    @auth
                        @if (auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="w-full min-h-[44px] flex items-center justify-center px-4 py-2.5 rounded-xl text-sm font-bold bg-[#6C4AB6] text-white">
                                Dashboard Admin
                            </a>
                        @endif
                    @else
                        <a href="{{ route('admin.login') }}" class="w-full min-h-[44px] flex items-center justify-center px-4 py-2.5 rounded-xl text-sm font-bold bg-[#FF9F43] text-white">
                            Login Admin
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#20243A] text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <div class="lg:col-span-1">
                    <x-brand-logo variant="light" />
                    <p class="mt-4 text-sm text-slate-300 leading-relaxed">
                        Platform marketplace modern yang menghubungkan pelaku UMKM lokal unggulan Indonesia dengan masyarakat luas secara mudah, aman, dan terpercaya.
                    </p>
                    <div class="mt-5 flex items-center gap-3">
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram Zahran Kopi"
                           class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#FF9F43] flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 2A3.75 3.75 0 004 7.75v8.5A3.75 3.75 0 007.75 20h8.5A3.75 3.75 0 0020 16.25v-8.5A3.75 3.75 0 0016.25 4h-8.5zM12 7a5 5 0 110 10 5 5 0 010-10zm0 2a3 3 0 100 6 3 3 0 000-6zm5.25-2.5a1 1 0 110 2 1 1 0 010-2z"/></svg>
                        </a>
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook Zahran Kopi"
                           class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#FF9F43] flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M13.5 22v-8h2.7l.4-3h-3.1V9.1c0-.9.3-1.5 1.6-1.5h1.6V4.9c-.3 0-1.3-.1-2.4-.1-2.4 0-4 1.4-4 4.1V11H7.5v3h2.8v8h3.2z"/></svg>
                        </a>
                        <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp Zahran Kopi"
                           class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#FF9F43] flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 00-8.6 15.1L2 22l5.1-1.3A10 10 0 1012 2zm0 18a8 8 0 01-4.1-1.1l-.3-.2-3 .8.8-2.9-.2-.3A8 8 0 1112 20zm4.4-5.9c-.2-.1-1.4-.7-1.6-.8-.2-.1-.4-.1-.6.1-.2.2-.7.8-.8 1-.2.2-.3.2-.5.1a6.6 6.6 0 01-3.3-2.9c-.2-.4.2-.4.6-1.2.1-.2 0-.4 0-.5-.1-.1-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.2.3-.9.9-.9 2.2s1 2.6 1.1 2.8c.1.2 1.9 3 4.7 4.2.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.4-.6 1.6-1.2.2-.6.2-1.1.1-1.2 0-.1-.2-.2-.4-.3z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#FF9F43] mb-4">Navigasi</h4>
                    <ul class="space-y-2.5 text-sm text-slate-300">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-white transition-colors">Semua Produk</a></li>
                        <li><a href="{{ route('categories.index') }}" class="hover:text-white transition-colors">Kategori Produk</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('contact.index') }}" class="hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#FF9F43] mb-4">Layanan UMKM</h4>
                    <ul class="space-y-2.5 text-sm text-slate-300">
                        <li>Kurasi Produk Berkualitas</li>
                        <li>Pemesanan Langsung via WhatsApp</li>
                        <li>Dukungan Pemasaran Digital</li>
                        <li><a href="{{ route('admin.login') }}" class="hover:text-white transition-colors">Portal Admin Pengelola</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#FF9F43] mb-4">Informasi Usaha</h4>
                    <ul class="space-y-3 text-sm text-slate-300">
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#FF9F43] font-bold">Alamat:</span>
                            <span>Jl. Merdeka Kreatif No. 45, Bandung, Jawa Barat 40111</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#FF9F43] font-bold">Email:</span>
                            <span>halo@zahrankopi.id</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#FF9F43] font-bold">WhatsApp:</span>
                            <span>+62 812-3456-7890</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
                <p>&copy; {{ date('Y') }} Zahran Kopi. Seluruh hak cipta dilindungi. Dibuat untuk memberdayakan UMKM Indonesia.</p>
                <p>Laravel {{ app()->version() }} &bull; Desain Modern UMKM</p>
            </div>
        </div>
    </footer>
</body>
</html>
