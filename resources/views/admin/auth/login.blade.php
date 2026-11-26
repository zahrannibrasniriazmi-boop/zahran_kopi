<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — Zahran Kopi</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F8F9FC] text-[#20243A] flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block">
                <x-brand-logo size="lg" />
            </a>
        </div>

        <div class="bg-white rounded-[2rem] border border-slate-200/80 shadow-xl shadow-indigo-950/5 p-8 sm:p-10">
            <div class="mb-6">
                <span class="inline-block px-3 py-1 rounded-full bg-[#F1ECFB] text-[#6C4AB6] text-xs font-bold">
                    Portal Administrator
                </span>
                <h1 class="mt-3 text-2xl font-extrabold text-[#20243A]">Masuk ke Dashboard</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Kelola produk UMKM, kategori, dan pesan pelanggan Zahran Kopi.
                </p>
            </div>

            <x-flash-alert />

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
                        Email Administrator
                    </label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           placeholder="admin@zahrankopi.id"
                           class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('email') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">
                    @error('email')
                        <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
                        Kata Sandi
                    </label>
                    <input type="password"
                           id="password"
                           name="password"
                           required
                           placeholder="Masukkan kata sandi"
                           class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('password') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">
                    @error('password')
                        <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-[#6C4AB6] focus:ring-[#6C4AB6]">
                        Ingat sesi saya
                    </label>
                </div>

                <button type="submit"
                        class="w-full py-3.5 rounded-full bg-[#6C4AB6] hover:bg-[#57389D] text-white font-bold text-sm shadow-lg shadow-purple-500/20 transition-all cursor-pointer">
                    Masuk ke Dashboard Admin
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-100 text-center">
                <a href="{{ route('home') }}" class="text-xs font-bold text-[#6C4AB6] hover:text-[#57389D]">
                    &larr; Kembali ke Halaman Publik Zahran Kopi
                </a>
            </div>
        </div>
    </div>
</body>
</html>
