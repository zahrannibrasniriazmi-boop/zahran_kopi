@extends('layouts.admin')

@section('title', 'Kelola Kategori — Admin @difMarket')
@section('page_title', 'Manajemen Kategori Produk')
@section('page_subtitle', 'Atur pengelompokan produk UMKM pada marketplace @difMarket')

@section('content')
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-base font-extrabold text-[#20243A]">Daftar Kategori ({{ $categories->total() }})</h2>
                <p class="text-xs text-slate-500">Kategori membantu pembeli menemukan produk lebih cepat.</p>
            </div>
            <a href="{{ route('admin.categories.create') }}"
               class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full bg-[#6C4AB6] hover:bg-[#57389D] text-white text-xs font-bold shadow-sm transition-colors self-start sm:self-auto">
                + Tambah Kategori
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#F8F9FC] text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-6 py-3.5 font-bold">Kategori</th>
                        <th class="px-4 py-3.5 font-bold">Slug</th>
                        <th class="px-4 py-3.5 font-bold">Deskripsi</th>
                        <th class="px-4 py-3.5 font-bold">Jumlah Produk</th>
                        <th class="px-6 py-3.5 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-slate-50/70">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-[#F1ECFB] text-[#6C4AB6] flex items-center justify-center shrink-0">
                                        <x-category-icon :name="$category->icon ?? 'tag'" class="w-5 h-5" />
                                    </div>
                                    <span class="font-bold text-[#20243A]">{{ $category->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 font-mono text-xs text-slate-500">
                                {{ $category->slug }}
                            </td>
                            <td class="px-4 py-4 text-slate-500 max-w-xs">
                                <p class="line-clamp-2 text-xs">{{ $category->description ?: '-' }}</p>
                            </td>
                            <td class="px-4 py-4">
                                <span class="px-3 py-1 rounded-full bg-[#FFF3E6] text-[#E6872B] text-xs font-bold">
                                    {{ $category->products_count }} produk
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('categories.show', $category->slug) }}" target="_blank" rel="noopener noreferrer"
                                       class="px-3 py-1.5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors">
                                        Lihat
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       class="px-3.5 py-1.5 rounded-full bg-[#F1ECFB] hover:bg-[#6C4AB6] text-[#6C4AB6] hover:text-white text-xs font-bold transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" data-delete-form>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                data-delete-trigger
                                                data-item-name="kategori {{ $category->name }}"
                                                class="px-3.5 py-1.5 rounded-full bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white text-xs font-bold transition-colors cursor-pointer">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">Belum ada kategori terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($categories->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection
