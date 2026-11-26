@props(['product'])

<article class="group bg-white rounded-3xl border border-slate-200/80 overflow-hidden card-hover flex flex-col h-full">
    <a href="{{ route('products.show', $product->slug) }}" class="relative block aspect-[4/3] overflow-hidden bg-[#F8F9FC]">
        <img
            src="{{ $product->image_url }}"
            alt="{{ $product->name }}"
            loading="lazy"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
        >
        <div class="absolute top-3.5 left-3.5 flex flex-wrap gap-2">
            @if ($product->category)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/95 text-[#6C4AB6] shadow-sm backdrop-blur-sm">
                    {{ $product->category->name }}
                </span>
            @endif
            @if ($product->is_featured)
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-[#FF9F43] text-white shadow-sm">
                    Unggulan
                </span>
            @endif
        </div>
        <div class="absolute bottom-3 right-3">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold {{ $product->stock > 0 ? 'bg-emerald-500/90 text-white' : 'bg-rose-500/90 text-white' }} backdrop-blur-sm">
                {{ $product->stock > 0 ? 'Stok: ' . $product->stock : 'Stok Habis' }}
            </span>
        </div>
    </a>

    <div class="p-5 flex flex-col flex-1">
        @if ($product->seller_name)
            <p class="text-xs font-medium text-slate-400 mb-1 truncate">
                {{ $product->seller_name }}
            </p>
        @endif

        <h3 class="text-base font-bold text-[#20243A] leading-snug line-clamp-2 group-hover:text-[#6C4AB6] transition-colors">
            <a href="{{ route('products.show', $product->slug) }}">
                {{ $product->name }}
            </a>
        </h3>

        <p class="mt-2 text-sm text-slate-500 line-clamp-2 leading-relaxed">
            {{ \Illuminate\Support\Str::limit(strip_tags($product->description), 88) }}
        </p>

        <div class="mt-auto pt-4 flex items-center justify-between gap-3 border-t border-slate-100">
            <div>
                <span class="block text-[11px] uppercase tracking-wider text-slate-400 font-semibold">Harga</span>
                <span class="text-lg font-extrabold text-[#6C4AB6]">
                    {{ $product->formatted_price }}
                </span>
            </div>

            <a href="{{ route('products.show', $product->slug) }}"
               class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-full bg-[#6C4AB6] hover:bg-[#57389D] text-white text-xs font-semibold shadow-sm transition-all duration-200 hover:shadow-md shrink-0">
                Lihat Detail
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</article>
