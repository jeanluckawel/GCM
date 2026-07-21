@props([
    'variant' => 'neutral',
])

@php
    $variants = [
        'neutral' => 'bg-slate-100 text-slate-700 ring-slate-200',
        'primary' => 'bg-slate-900 text-white ring-slate-900',
        'success' => 'bg-emerald-100 text-emerald-800 ring-emerald-200',
        'warning' => 'bg-amber-100 text-amber-800 ring-amber-200',
        'danger' => 'bg-rose-100 text-rose-800 ring-rose-200',
    ];
@endphp

<span {{ $attributes->class([
    'inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium ring-1 ring-inset',
    $variants[$variant] ?? $variants['neutral'],
]) }}>
    {{ $slot }}
</span>
