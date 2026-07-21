@props([
    'title' => 'No data available',
    'description' => null,
])

<div {{ $attributes->class('flex flex-col items-center justify-center rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-6 py-12 text-center') }}>
    @isset($icon)
        <div class="mb-4 text-slate-400">
            {{ $icon }}
        </div>
    @endisset

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
