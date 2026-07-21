@props([
    'label' => 'Loading',
])

<div {{ $attributes->class('inline-flex items-center gap-2 text-sm text-slate-500') }}>
    <span class="h-4 w-4 animate-spin rounded-full border-2 border-slate-300 border-t-slate-900"></span>
    <span>{{ $label }}</span>
</div>
