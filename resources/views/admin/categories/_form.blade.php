@php
    $isEdit = isset($category);
    $icons = [
        'utensils' => 'Kuliner & Minuman',
        'shirt' => 'Fashion & Batik',
        'sparkles' => 'Kerajinan Tangan',
        'leaf' => 'Kesehatan & Herbal',
        'home' => 'Dekorasi Rumah',
        'tag' => 'Umum / Lainnya',
    ];
@endphp

<div class="space-y-5 max-w-2xl">
    <div>
        <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
            Nama Kategori <span class="text-rose-500">*</span>
        </label>
        <input type="text"
               id="name"
               name="name"
               data-slug-source
               value="{{ old('name', $category->name ?? '') }}"
               placeholder="Contoh: Kuliner & Minuman"
               class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('name') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">
        @error('name')
            <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
            <label for="slug" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
                Slug URL
            </label>
            <input type="text"
                   id="slug"
                   name="slug"
                   data-slug-target
                   data-is-create="{{ $isEdit ? 'false' : 'true' }}"
                   value="{{ old('slug', $category->slug ?? '') }}"
                   placeholder="otomatis-dari-nama"
                   class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('slug') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">
            @error('slug')
                <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="icon" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
                Ikon Kategori
            </label>
            <select id="icon"
                    name="icon"
                    class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('icon') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">
                @foreach ($icons as $value => $label)
                    <option value="{{ $value }}" @selected(old('icon', $category->icon ?? 'tag') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('icon')
                <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="description" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
            Deskripsi Kategori
        </label>
        <textarea id="description"
                  name="description"
                  rows="4"
                  placeholder="Jelaskan jenis produk UMKM yang masuk ke kategori ini..."
                  class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('description') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">{{ old('description', $category->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
        <a href="{{ route('admin.categories.index') }}"
           class="px-6 py-3 rounded-full bg-slate-100 hover:bg-slate-200 text-[#20243A] text-sm font-bold transition-colors">
            Batal
        </a>
        <button type="submit"
                class="px-8 py-3 rounded-full bg-[#6C4AB6] hover:bg-[#57389D] text-white text-sm font-bold shadow-md transition-colors cursor-pointer">
            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Kategori' }}
        </button>
    </div>
</div>
