@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
    'disabled' => false,
])

@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-xl font-medium transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 disabled:pointer-events-none disabled:opacity-50';

    $variants = [
        'primary' => 'bg-slate-900 text-white hover:bg-slate-800',
        'secondary' => 'bg-slate-100 text-slate-900 hover:bg-slate-200',
        'ghost' => 'bg-transparent text-slate-700 hover:bg-slate-100 hover:text-slate-900',
        'danger' => 'bg-rose-600 text-white hover:bg-rose-700',
        'link' => 'bg-transparent px-0 text-slate-900 hover:text-slate-700 underline-offset-4 hover:underline',
    ];

    $sizes = [
        'sm' => 'h-8 px-3 text-sm',
        'md' => 'h-10 px-4 text-sm',
        'lg' => 'h-12 px-5 text-base',
    ];

    $classes = trim($base.' '.($variants[$variant] ?? $variants['primary']).' '.($sizes[$size] ?? $sizes['md']));
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>
        @isset($icon)
            <span class="inline-flex shrink-0 items-center justify-center">
                {{ $icon }}
            </span>
        @endisset

        <span>{{ $slot }}</span>
    </a>
@else
    <button type="{{ $type }}" @disabled($disabled) {{ $attributes->class($classes) }}>
        @isset($icon)
            <span class="inline-flex shrink-0 items-center justify-center">
                {{ $icon }}
            </span>
        @endisset

        <span>{{ $slot }}</span>
    </button>
@endif
