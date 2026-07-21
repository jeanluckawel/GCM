@props([
    'title' => null,
    'meta' => null,
    'href' => null,
    'selected' => false,
])

@if($href)
    <a
        href="{{ $href }}"
        {{ $attributes->class([
            'group block rounded-2xl border bg-white p-5 shadow-sm shadow-slate-100 transition-colors duration-150',
            'border-slate-200 hover:border-slate-300 hover:bg-slate-50' => ! $selected,
            'border-slate-900 ring-1 ring-slate-900' => $selected,
        ]) }}
    >
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" class="h-6 w-6">
                    <path d="M3.75 7.5A2.25 2.25 0 0 1 6 5.25h3.21c.6 0 1.17.24 1.59.66l1.29 1.34c.42.42.99.66 1.59.66H18A2.25 2.25 0 0 1 20.25 10.17v6.08A2.25 2.25 0 0 1 18 18.5H6A2.25 2.25 0 0 1 3.75 16.25V7.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                </svg>
            </div>

            <div class="min-w-0 flex-1">
                @if($title)
                    <h3 class="truncate text-sm font-semibold text-slate-900">
                        {{ $title }}
                    </h3>
                @endif

                @if($meta)
                    <p class="mt-1 text-sm text-slate-500">
                        {{ $meta }}
                    </p>
                @endif
            </div>
        </div>
    </a>
@else
    <div
        {{ $attributes->class([
            'group block rounded-2xl border bg-white p-5 shadow-sm shadow-slate-100 transition-colors duration-150',
            'border-slate-200 hover:border-slate-300 hover:bg-slate-50' => ! $selected,
            'border-slate-900 ring-1 ring-slate-900' => $selected,
        ]) }}
    >
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" class="h-6 w-6">
                    <path d="M3.75 7.5A2.25 2.25 0 0 1 6 5.25h3.21c.6 0 1.17.24 1.59.66l1.29 1.34c.42.42.99.66 1.59.66H18A2.25 2.25 0 0 1 20.25 10.17v6.08A2.25 2.25 0 0 1 18 18.5H6A2.25 2.25 0 0 1 3.75 16.25V7.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                </svg>
            </div>

            <div class="min-w-0 flex-1">
                @if($title)
                    <h3 class="truncate text-sm font-semibold text-slate-900">
                        {{ $title }}
                    </h3>
                @endif

                @if($meta)
                    <p class="mt-1 text-sm text-slate-500">
                        {{ $meta }}
                    </p>
                @endif
            </div>
        </div>
    </div>
@endif
