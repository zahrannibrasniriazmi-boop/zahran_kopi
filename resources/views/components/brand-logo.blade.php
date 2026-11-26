@props([
    'variant' => 'dark',
    'size' => 'md',
])

@php
    $iconSizes = match ($size) {
        'sm' => 'h-8 w-8',
        'lg' => 'h-11 w-11',
        default => 'h-9 w-9',
    };
    $textSizes = match ($size) {
        'sm' => 'text-lg',
        'lg' => 'text-2xl',
        default => 'text-xl',
    };
    $textColor = $variant === 'light' ? 'text-white' : 'text-[#20243A]';
    $subColor = $variant === 'light' ? 'text-white/75' : 'text-slate-500';
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5 select-none']) }}>
    <svg class="{{ $iconSizes }} shrink-0" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <rect width="64" height="64" rx="16" fill="#6C4AB6"/>
        <path d="M21 25C21 18.9249 25.9249 14 32 14C38.0751 14 43 18.9249 43 25" stroke="#FFFFFF" stroke-width="4" stroke-linecap="round"/>
        <rect x="14" y="24" width="36" height="28" rx="9" fill="#FFFFFF"/>
        <circle cx="32" cy="38" r="7" fill="#6C4AB6"/>
        <circle cx="47" cy="21" r="6" fill="#FF9F43"/>
    </svg>
    <span class="flex flex-col leading-none">
        <span class="{{ $textSizes }} font-extrabold tracking-tight {{ $textColor }}">
            <span class="text-[#FF9F43]">@</span>dif<span class="text-[#6C4AB6]">{{ $variant === 'light' ? '' : 'Market' }}</span>@if($variant === 'light')<span class="text-white">Market</span>@endif
        </span>
        <span class="text-[10px] font-semibold uppercase tracking-widest {{ $subColor }} mt-0.5">
            Marketplace UMKM
        </span>
    </span>
</span>
