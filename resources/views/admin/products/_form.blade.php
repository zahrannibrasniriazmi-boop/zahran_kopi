@php
    $isEdit = isset($product);
@endphp

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <div class="lg:col-span-8 space-y-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
                    Nama Produk <span class="text-rose-500">*</span>
                </label>
                <input type="text"
                       id="name"
                       name="name"
                       data-slug-source
                       value="{{ old('name', $product->name ?? '') }}"
                       placeholder="Contoh: Kopi Arabika Gayo 250g"
                       class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('name') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">
                @error('name')
                    <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="slug" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
                    Slug URL
                </label>
                <input type="text"
                       id="slug"
                       name="slug"
                       data-slug-target
                       data-is-create="{{ $isEdit ? 'false' : 'true' }}"
                       value="{{ old('slug', $product->slug ?? '') }}"
                       placeholder="otomatis-dari-nama-produk"
                       class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('slug') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">
                @error('slug')
                    <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div>
                <label for="category_id" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
                    Kategori <span class="text-rose-500">*</span>
                </label>
                <select id="category_id"
                        name="category_id"
                        class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('category_id') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) old('category_id', $product->category_id ?? '') === (string) $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="price" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
                    Harga (Rp) <span class="text-rose-500">*</span>
                </label>
                <input type="number"
                       id="price"
                       name="price"
                       min="0"
                       value="{{ old('price', $product->price ?? '') }}"
                       placeholder="85000"
                       class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('price') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">
                @error('price')
                    <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="stock" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
                    Stok Produk <span class="text-rose-500">*</span>
                </label>
                <input type="number"
                       id="stock"
                       name="stock"
                       min="0"
                       value="{{ old('stock', $product->stock ?? 0) }}"
                       placeholder="25"
                       class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('stock') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">
                @error('stock')
                    <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="seller_name" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
                    Nama Pelaku UMKM / Penjual
                </label>
                <input type="text"
                       id="seller_name"
                       name="seller_name"
                       value="{{ old('seller_name', $product->seller_name ?? '') }}"
                       placeholder="Contoh: UMKM Kopi Serambi"
                       class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('seller_name') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">
            </div>

            <div>
                <label for="seller_whatsapp" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
                    Nomor WhatsApp Penjual
                </label>
                <input type="text"
                       id="seller_whatsapp"
                       name="seller_whatsapp"
                       value="{{ old('seller_whatsapp', $product->seller_whatsapp ?? '6281234567890') }}"
                       placeholder="6281234567890"
                       class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('seller_whatsapp') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">
            </div>
        </div>

        <div>
            <label for="description" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-2">
                Deskripsi Lengkap <span class="text-rose-500">*</span>
            </label>
            <textarea id="description"
                      name="description"
                      rows="5"
                      placeholder="Jelaskan bahan, keunggulan, ukuran, dan detail produk UMKM..."
                      class="w-full px-4 py-3 rounded-2xl bg-[#F8F9FC] border @error('description') border-rose-400 @else border-slate-200 @enderror text-sm focus:outline-none focus:border-[#6C4AB6] focus:bg-white">{{ old('description', $product->description ?? '') }}</textarea>
            @error('description')
                <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <label class="inline-flex items-center gap-3 p-4 rounded-2xl bg-[#F8F9FC] border border-slate-200 cursor-pointer">
            <input type="checkbox"
                   name="is_featured"
                   value="1"
                   @checked(old('is_featured', $product->is_featured ?? false))
                   class="w-4 h-4 rounded text-[#6C4AB6] focus:ring-[#6C4AB6]">
            <span>
                <span class="block text-sm font-bold text-[#20243A]">Tampilkan sebagai Produk Unggulan</span>
                <span class="block text-xs text-slate-500">Produk unggulan diprioritaskan di bagian atas halaman Beranda.</span>
            </span>
        </label>
    </div>

    <!-- Upload Gambar Produk -->
    <div class="lg:col-span-4 space-y-4">
        <div class="bg-[#F8F9FC] rounded-3xl p-5 border border-slate-200">
            <label for="image" class="block text-xs font-bold uppercase tracking-wider text-[#20243A] mb-3">
                Foto Produk @if(! $isEdit)<span class="text-rose-500">*</span>@endif
            </label>

            <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-white border border-dashed border-slate-300 flex items-center justify-center mb-4">
                <img data-image-preview
                     src="{{ $isEdit ? $product->image_url : '' }}"
                     alt="Pratinjau foto produk"
                     class="{{ $isEdit ? '' : 'hidden' }} w-full h-full object-cover">

                @unless ($isEdit)
                    <div data-image-placeholder class="text-center p-4">
                        <svg class="w-10 h-10 text-slate-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-xs font-semibold text-slate-400">Pratinjau gambar akan tampil di sini</p>
                    </div>
                @endunless
            </div>

            <input type="file"
                   id="image"
                   name="image"
                   accept=".jpg,.jpeg,.png,.webp"
                   data-image-input
                   class="block w-full text-xs text-slate-600 file:mr-3 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-[#6C4AB6] file:text-white hover:file:bg-[#57389D] cursor-pointer">

            <p data-image-meta class="hidden mt-2 text-xs font-semibold text-[#6C4AB6]"></p>
            <p class="mt-2.5 text-[11px] text-slate-500 leading-relaxed">
                Format yang didukung: <strong>JPG, JPEG, PNG, atau WEBP</strong>. Maksimal ukuran file <strong>2 MB</strong>.
                @if ($isEdit)
                    Biarkan kosong jika tidak ingin mengganti gambar saat ini.
                @endif
            </p>
            @error('image')
                <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap items-center justify-end gap-3">
    <a href="{{ route('admin.products.index') }}"
       class="px-6 py-3 rounded-full bg-slate-100 hover:bg-slate-200 text-[#20243A] text-sm font-bold transition-colors">
        Batal
    </a>
    <button type="submit"
            class="px-8 py-3 rounded-full bg-[#6C4AB6] hover:bg-[#57389D] text-white text-sm font-bold shadow-md transition-colors cursor-pointer">
        {{ $isEdit ? 'Simpan Perubahan Produk' : 'Simpan Produk Baru' }}
    </button>
</div>
