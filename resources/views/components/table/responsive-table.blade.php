@props([
    'striped' => false,
    'compact' => false,
])

<div {{ $attributes->class('overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm shadow-slate-100') }}>
    <div class="overflow-x-auto">
        <table class="{{ $compact ? 'text-sm' : 'text-sm' }} min-w-full divide-y divide-slate-200">
            {{ $slot }}
        </table>
    </div>
</div>
