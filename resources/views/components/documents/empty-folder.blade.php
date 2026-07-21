@props([
    'title' => 'This folder is empty',
    'description' => null,
])

<div {{ $attributes->class('flex flex-col items-center justify-center rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-6 py-12 text-center') }}>
    <div class="mb-4 text-slate-400">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" class="h-12 w-12">
            <path d="M3.75 7.5A2.25 2.25 0 0 1 6 5.25h3.21c.6 0 1.17.24 1.59.66l1.29 1.34c.42.42.99.66 1.59.66H18A2.25 2.25 0 0 1 20.25 10.17v6.08A2.25 2.25 0 0 1 18 18.5H6A2.25 2.25 0 0 1 3.75 16.25V7.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
        </svg>
    </div>

    <h3 class="text-base font-semibold text-slate-900">
        {{ $title }}
    </h3>

    @if($description)
        <p class="mt-2 max-w-md text-sm leading-6 text-slate-500">
            {{ $description }}
        </p>
    @endif

    @isset($actions)
        <div class="mt-6 flex flex-wrap items-center justify-center gap-2">
            {{ $actions }}
        </div>
    @endisset
</div>
