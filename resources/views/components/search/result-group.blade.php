@props([
    'title',
    'count' => null,
    'icon' => null,
])

<section {{ $attributes->class('px-2 py-2') }}>
    <div class="flex items-center justify-between gap-3 px-2 pb-2">
        <div class="flex min-w-0 items-center gap-2">
            @if($icon)
                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-slate-100 text-slate-500">
                    <i class="{{ $icon }}"></i>
                </span>
            @endif

            <h3 class="truncate text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">
                {{ $title }}
            </h3>
        </div>

        @if(! is_null($count))
            <span class="rounded-full bg-slate-100 px-2 py-1 text-[11px] font-medium text-slate-600 ring-1 ring-inset ring-slate-200">
                {{ $count }}
            </span>
        @endif
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm shadow-slate-100">
        {{ $slot }}
    </div>
</section>
