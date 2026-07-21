@props([
    'lines' => 1,
])

<div {{ $attributes->class('space-y-3') }}>
    @for($i = 0; $i < $lines; $i++)
        <div class="h-4 animate-pulse rounded-lg bg-slate-200"></div>
    @endfor
</div>
