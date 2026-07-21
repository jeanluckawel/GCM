@props([
    'href',
    'title',
    'meta' => null,
    'badge' => null,
    'initials' => null,
    'icon' => 'bi bi-arrow-up-right',
])

<a
    href="{{ $href }}"
    data-search-result
    class="group flex items-center gap-3 px-4 py-3 text-left transition-colors duration-150 hover:bg-slate-50 focus:bg-slate-50 focus:outline-none"
>
    <x-ui.avatar :initials="$initials" size="sm" class="shrink-0 bg-slate-100 text-slate-600 ring-slate-200" />

    <div class="min-w-0 flex-1">
        <div class="flex flex-wrap items-center gap-2">
            <span class="truncate text-sm font-semibold text-slate-900">
                {{ $title }}
            </span>

            @if($badge)
                <x-ui.badge variant="neutral">
                    {{ $badge }}
                </x-ui.badge>
            @endif
        </div>

        @if($meta)
            <p class="mt-1 truncate text-xs text-slate-500">
                {{ $meta }}
            </p>
        @endif
    </div>

    <i class="{{ $icon }} shrink-0 text-slate-300 transition-colors duration-150 group-hover:text-slate-500"></i>
</a>
