@props([
    'src' => null,
    'alt' => null,
    'initials' => null,
    'size' => 'md',
])

@php
    $sizes = [
        'sm' => 'h-8 w-8 text-xs',
        'md' => 'h-10 w-10 text-sm',
        'lg' => 'h-12 w-12 text-base',
    ];
@endphp

<div {{ $attributes->class([
    'inline-flex items-center justify-center overflow-hidden rounded-full bg-slate-100 text-slate-600 ring-1 ring-slate-200',
    $sizes[$size] ?? $sizes['md'],
]) }}>
    @if($src)
        <img src="{{ $src }}" alt="{{ $alt }}" class="h-full w-full object-cover">
    @else
        <span class="font-medium">
            {{ $initials }}
        </span>
    @endif
</div>
