@props(['product'])

<article class="group bg-white rounded-2xl border border-slate-200/80 overflow-hidden card-hover flex flex-col h-full">
    <a href="{{ route('products.show', $product->slug) }}" class="relative block aspect-[4/3] overflow-hidden bg-slate-100">
        <img
            src="{{ $product->image_url }}"
            alt="{{ $product->name }}"
            loading="lazy"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
        >
        @if ($product->is_featured)
            <span class="absolute top-3 left-3 inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-[#FF9F43] text-white shadow-xs">
                Unggulan
            </span>
        @elseif ($product->category)
            <span class="absolute top-3 left-3 inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-white/95 text-[#20243A] shadow-xs backdrop-blur-xs">
                {{ $product->category->name }}
            </span>
        @endif
    </a>

    <div class="p-4 sm:p-5 flex flex-col flex-1">
        <div class="flex items-center justify-between gap-2 mb-1.5">
            <span class="text-xs font-medium text-slate-500 truncate">
                {{ $product->seller_name ?: 'Mitra UMKM' }}
            </span>
            <span class="inline-flex items-center gap-1 text-[11px] font-semibold shrink-0 {{ $product->stock > 0 ? 'text-emerald-700' : 'text-rose-600' }}">
                <span class="w-1.5 h-1.5 rounded-full {{ $product->stock > 0 ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                {{ $product->stock > 0 ? 'Stok ' . $product->stock : 'Habis' }}
            </span>
        </div>

        <h3 class="text-base font-bold text-[#20243A] leading-snug line-clamp-2 group-hover:text-[#6C4AB6] transition-colors">
            <a href="{{ route('products.show', $product->slug) }}">
                {{ $product->name }}
            </a>
        </h3>

        <p class="mt-1.5 text-sm text-slate-500 line-clamp-2 leading-relaxed">
            {{ \Illuminate\Support\Str::limit(strip_tags($product->description), 82) }}
        </p>

        <div class="mt-auto pt-4 flex items-center justify-between gap-3 border-t border-slate-100">
            <div class="min-w-0">
                <span class="block text-[11px] font-medium text-slate-400">Harga</span>
                <span class="text-base sm:text-lg font-extrabold text-[#6C4AB6] tabular-nums">
                    {{ $product->formatted_price }}
                </span>
            </div>

            <a href="{{ route('products.show', $product->slug) }}"
               class="inline-flex items-center justify-center gap-1.5 min-h-[40px] px-4 py-2 rounded-xl bg-[#F1ECFB] hover:bg-[#6C4AB6] text-[#6C4AB6] hover:text-white text-xs font-bold transition-colors shrink-0">
                Detail
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</article>
