@extends('layouts.app')

@section('title', 'Kontak Kami — Zahran Kopi')

@section('content')
    <section class="bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <span class="text-xs font-bold uppercase tracking-widest text-[#FF9F43]">Layanan &amp; Kemitraan</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-[#20243A] mt-1">Hubungi Zahran Kopi</h1>
            <p class="mt-2.5 text-sm sm:text-base text-slate-500 max-w-2xl">
                Punya pertanyaan seputar produk UMKM, kerja sama pemasaran, atau ingin mendaftarkan produk Anda? Kirimkan pesan melalui formulir di bawah ini.
            </p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
        <x-flash-alert />

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Info Kontak -->
            <div class="lg:col-span-5 space-y-5">
                <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-sm space-y-6">
                    <h2 class="text-xl font-extrabold text-[#20243A]">Informasi Kontak Resmi</h2>

                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-2xl bg-[#F1ECFB] text-[#6C4AB6] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Email</p>
                            <a href="mailto:halo@zahrankopi.id" class="text-sm font-bold text-[#20243A] hover:text-[#6C4AB6]">
                                halo@zahrankopi.id
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-2xl bg-[#FFF3E6] text-[#FF9F43] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Nomor WhatsApp</p>
                            <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="text-sm font-bold text-[#20243A] hover:text-[#6C4AB6]">
                                +62 812-3456-7890
                            </a>
                            <p class="text-xs text-slate-500 mt-0.5">Senin – Sabtu, 08.00 – 17.00 WIB</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Alamat Usaha</p>
                            <p class="text-sm font-semibold text-[#20243A] leading-relaxed">
                                Jl. Merdeka Kreatif No. 45, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40111
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulir Pesan -->
            <div class="lg:col-span-7">
                <div class="bg-white rounded-3xl p-7 sm:p-9 border border-slate-200/80 shadow-sm">
                    <h2 class="text-xl font-extrabold text-[#20243A]">Kirim Pesan Kepada Kami</h2>
                    <p class="mt-1 text-sm text-slate-500">Isi formulir berikut dengan lengkap, tim kami akan merespons secepatnya.</p>

                    <form action="{{ route('contact.store') }}" method="POST" class="mt-6 space-y-5">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
                                    Nama Lengkap <span class="text-rose-500">*</span>
                                </label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       placeholder="Contoh: Budi Santoso"
                                       class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('name') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">
                                @error('name')
                                    <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
                                    Alamat Email <span class="text-rose-500">*</span>
                                </label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       placeholder="nama@email.com"
                                       class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('email') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">
                                @error('email')
                                    <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
                                    Nomor WhatsApp (Opsional)
                                </label>
                                <input type="text"
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       placeholder="0812xxxxxxxx"
                                       class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('phone') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">
                                @error('phone')
                                    <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="subject" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
                                    Subjek Pesan <span class="text-rose-500">*</span>
                                </label>
                                <input type="text"
                                       id="subject"
                                       name="subject"
                                       value="{{ old('subject') }}"
                                       placeholder="Contoh: Pendaftaran Mitra UMKM"
                                       class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('subject') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">
                                @error('subject')
                                    <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
                                Isi Pesan <span class="text-rose-500">*</span>
                            </label>
                            <textarea id="message"
                                      name="message"
                                      rows="5"
                                      placeholder="Tuliskan pertanyaan atau kebutuhan Anda di sini..."
                                      class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('message') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full bg-[#6C4AB6] hover:bg-[#57389D] text-white font-bold text-sm shadow-md transition-all cursor-pointer">
                                Kirim Pesan Sekarang
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
