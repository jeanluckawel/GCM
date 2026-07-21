@props([
    'type' => 'file',
    'label' => null,
])

@php
    $tones = [
        'pdf' => 'bg-rose-100 text-rose-700',
        'doc' => 'bg-sky-100 text-sky-700',
        'docx' => 'bg-sky-100 text-sky-700',
        'xls' => 'bg-emerald-100 text-emerald-700',
        'xlsx' => 'bg-emerald-100 text-emerald-700',
        'img' => 'bg-violet-100 text-violet-700',
        'file' => 'bg-slate-100 text-slate-600',
    ];

    $tone = $tones[$type] ?? $tones['file'];
@endphp

<div {{ $attributes->class(['inline-flex h-10 w-10 items-center justify-center rounded-xl text-xs font-semibold uppercase tracking-wide', $tone]) }}>
    {{ $label ?? strtoupper($type) }}
</div>
