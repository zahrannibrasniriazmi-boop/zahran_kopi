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
    $accentWordColor = $variant === 'light' ? 'text-[#FF9F43]' : 'text-[#6C4AB6]';
    $subColor = $variant === 'light' ? 'text-white/75' : 'text-slate-500';
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5 select-none']) }}>
    <svg class="{{ $iconSizes }} shrink-0" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <rect width="64" height="64" rx="16" fill="#6C4AB6"/>
        <path d="M23 18C23 15.5 25 14 25 12" stroke="#FF9F43" stroke-width="3" stroke-linecap="round"/>
        <path d="M31 17C31 14.5 33 13 33 11" stroke="#FF9F43" stroke-width="3" stroke-linecap="round"/>
        <path d="M39 18C39 15.5 41 14 41 12" stroke="#FF9F43" stroke-width="3" stroke-linecap="round"/>
        <path d="M18 25H44V37C44 43.6274 38.6274 49 32 49H30C23.3726 49 18 43.6274 18 37V25Z" fill="#FFFFFF"/>
        <path d="M44 28H47C49.7614 28 52 30.2386 52 33C52 35.7614 49.7614 38 47 38H44" stroke="#FFFFFF" stroke-width="3.5" stroke-linecap="round"/>
        <rect x="17" y="51" width="30" height="3.5" rx="1.75" fill="#FF9F43"/>
    </svg>
    <span class="flex flex-col leading-none">
        <span class="{{ $textSizes }} font-extrabold tracking-tight {{ $textColor }}">
            Zahran <span class="{{ $accentWordColor }}">Kopi</span>
        </span>
        <span class="text-[10px] font-semibold uppercase tracking-widest {{ $subColor }} mt-0.5">
            Marketplace UMKM
        </span>
    </span>
</span>
