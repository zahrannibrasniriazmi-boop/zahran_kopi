<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard — @difMarket')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F8F9FC] text-[#20243A] flex flex-col lg:flex-row">
    <!-- Sidebar Desktop & Mobile Drawer -->
    <aside id="admin-sidebar"
           class="hidden lg:flex lg:w-68 lg:flex-col lg:fixed lg:inset-y-0 bg-[#20243A] text-white z-40">
        <div class="px-6 py-6 border-b border-white/10 flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}">
                <x-brand-logo variant="light" size="sm" />
            </a>
            <button type="button" data-toggle-target="admin-sidebar" class="lg:hidden text-white/70 hover:text-white">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto" aria-label="Navigasi Admin">
            @php
                $adminMenus = [
                    ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'active' => request()->routeIs('admin.dashboard'), 'icon' => 'grid'],
                    ['label' => 'Kelola Produk', 'route' => 'admin.products.index', 'active' => request()->routeIs('admin.products.*'), 'icon' => 'box'],
                    ['label' => 'Kelola Kategori', 'route' => 'admin.categories.index', 'active' => request()->routeIs('admin.categories.*'), 'icon' => 'tag'],
                    ['label' => 'Pesan Masuk', 'route' => 'admin.messages.index', 'active' => request()->routeIs('admin.messages.*'), 'icon' => 'mail'],
                ];
            @endphp

            @foreach ($adminMenus as $menu)
                <a href="{{ route($menu['route']) }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition-all {{ $menu['active'] ? 'bg-[#6C4AB6] text-white shadow-md' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    @switch($menu['icon'])
                        @case('grid')
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            @break
                        @case('box')
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            @break
                        @case('tag')
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            @break
                        @case('mail')
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            @break
                    @endswitch
                    <span>{{ $menu['label'] }}</span>
                </a>
            @endforeach

            <div class="pt-4 mt-4 border-t border-white/10">
                <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold text-slate-300 hover:bg-white/10 hover:text-white transition-all">
                    <svg class="w-5 h-5 text-[#FF9F43]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    <span>Lihat Website Publik</span>
                </a>
            </div>
        </nav>

        <div class="p-4 border-t border-white/10">
            <div class="px-3 py-2 mb-2">
                <p class="text-xs text-slate-400">Masuk sebagai</p>
                <p class="text-sm font-bold text-white truncate">{{ auth()->user()->name }}</p>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-full bg-white/10 hover:bg-rose-500 text-white text-xs font-bold transition-colors cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Konten Utama Admin -->
    <div class="flex-1 lg:pl-68 flex flex-col min-h-screen">
        <!-- Topbar -->
        <header class="sticky top-0 z-30 bg-white/95 backdrop-blur-md border-b border-slate-200/80 px-4 sm:px-8 py-4 flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <button type="button"
                        data-toggle-target="admin-sidebar"
                        aria-label="Buka menu admin"
                        class="lg:hidden p-2 rounded-xl border border-slate-200 text-[#20243A] hover:bg-slate-100">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div>
                    <h1 class="text-lg sm:text-xl font-extrabold text-[#20243A]">@yield('page_title', 'Dashboard Admin')</h1>
                    <p class="text-xs text-slate-500 hidden sm:block">@yield('page_subtitle', 'Kelola katalog produk dan kategori UMKM @difMarket')</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.products.create') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-[#6C4AB6] hover:bg-[#57389D] text-white text-xs font-bold shadow-sm transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Produk
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" class="lg:hidden">
                    @csrf
                    <button type="submit" class="px-3.5 py-2 rounded-full bg-rose-50 text-rose-600 text-xs font-bold">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-8 max-w-7xl w-full mx-auto">
            <x-flash-alert />
            @yield('content')
        </main>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="delete-confirm-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 backdrop-blur-xs p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-7 shadow-2xl border border-slate-200">
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            <h3 class="text-lg font-extrabold text-[#20243A]">Konfirmasi Penghapusan</h3>
            <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                Apakah Anda yakin ingin menghapus <strong id="delete-item-name" class="text-[#20243A]">item ini</strong>? Tindakan ini tidak dapat dibatalkan.
            </p>
            <div class="mt-6 flex items-center justify-end gap-3">
                <button type="button" data-close-delete-modal
                        class="px-5 py-2.5 rounded-full bg-slate-100 hover:bg-slate-200 text-sm font-bold text-[#20243A] cursor-pointer">
                    Batal
                </button>
                <button type="button" id="confirm-delete-btn"
                        class="px-5 py-2.5 rounded-full bg-rose-600 hover:bg-rose-700 text-sm font-bold text-white cursor-pointer">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</body>
</html>
