@extends('layouts.admin')

@section('title', 'Kelola Produk — Admin Zahran Kopi')
@section('page_title', 'Daftar Produk UMKM')
@section('page_subtitle', 'Tambah, perbarui, atau hapus produk pada katalog Zahran Kopi')

@section('content')
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <!-- Header & Pencarian -->
        <div class="p-6 border-b border-slate-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3 flex-1 max-w-2xl">
                <input type="text"
                       name="q"
                       value="{{ $search }}"
                       placeholder="Cari nama produk atau penjual..."
                       class="flex-1 px-4 py-2.5 rounded-full bg-[#F8F9FC] border border-slate-200 text-sm focus:outline-none focus:border-[#6C4AB6]">

                <select name="category_id"
                        class="px-4 py-2.5 rounded-full bg-[#F8F9FC] border border-slate-200 text-sm focus:outline-none focus:border-[#6C4AB6]">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) $categoryId === (string) $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="px-5 py-2.5 rounded-full bg-[#20243A] hover:bg-[#6C4AB6] text-white text-xs font-bold transition-colors cursor-pointer">
                    Filter
                </button>
            </form>

            <a href="{{ route('admin.products.create') }}"
               class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full bg-[#6C4AB6] hover:bg-[#57389D] text-white text-xs font-bold shadow-sm transition-colors">
                + Tambah Produk
            </a>
        </div>

        <!-- Tabel Produk -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#F8F9FC] text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-6 py-3.5 font-bold">Produk</th>
                        <th class="px-4 py-3.5 font-bold">Kategori</th>
                        <th class="px-4 py-3.5 font-bold">Harga</th>
                        <th class="px-4 py-3.5 font-bold">Stok</th>
                        <th class="px-4 py-3.5 font-bold">Status</th>
                        <th class="px-6 py-3.5 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($products as $product)
                        <tr class="hover:bg-slate-50/70">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3.5">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                         class="w-14 h-12 rounded-xl object-cover bg-[#F8F9FC] border border-slate-200 shrink-0">
                                    <div class="min-w-0">
                                        <p class="font-bold text-[#20243A] line-clamp-1">{{ $product->name }}</p>
                                        <p class="text-xs text-slate-400">{{ $product->seller_name ?: 'Mitra UMKM' }} &bull; /{{ $product->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <span class="px-3 py-1 rounded-full bg-[#F1ECFB] text-[#6C4AB6] text-xs font-semibold">
                                    {{ $product->category?->name ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-4 font-bold text-[#20243A]">
                                {{ $product->formatted_price }}
                            </td>
                            <td class="px-4 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $product->stock > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                @if ($product->is_featured)
                                    <span class="px-2.5 py-1 rounded-full bg-[#FFF3E6] text-[#E6872B] text-xs font-bold">Unggulan</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-500 text-xs font-semibold">Reguler</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('products.show', $product->slug) }}" target="_blank" rel="noopener noreferrer"
                                       class="px-3 py-1.5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors">
                                        Lihat
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="px-3.5 py-1.5 rounded-full bg-[#F1ECFB] hover:bg-[#6C4AB6] text-[#6C4AB6] hover:text-white text-xs font-bold transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" data-delete-form>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                data-delete-trigger
                                                data-item-name="{{ $product->name }}"
                                                class="px-3.5 py-1.5 rounded-full bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white text-xs font-bold transition-colors cursor-pointer">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                Belum ada produk yang sesuai. Silakan tambahkan produk baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($products->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
