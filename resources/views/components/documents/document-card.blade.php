@props([
    'title' => null,
    'meta' => null,
    'href' => null,
])

@if($href)
    <a
        href="{{ $href }}"
        {{ $attributes->class('group block rounded-2xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-100 transition-colors duration-150 hover:border-slate-300 hover:bg-slate-50') }}
    >
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" class="h-6 w-6">
                    <path d="M7.5 3.75h7.5l4.5 4.5v12a2.25 2.25 0 0 1-2.25 2.25h-9.75A2.25 2.25 0 0 1 5.25 20.25V6A2.25 2.25 0 0 1 7.5 3.75Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                    <path d="M15 3.75V8.25h4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
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
    <div {{ $attributes->class('group block rounded-2xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-100 transition-colors duration-150 hover:border-slate-300 hover:bg-slate-50') }}>
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" class="h-6 w-6">
                    <path d="M7.5 3.75h7.5l4.5 4.5v12a2.25 2.25 0 0 1-2.25 2.25h-9.75A2.25 2.25 0 0 1 5.25 20.25V6A2.25 2.25 0 0 1 7.5 3.75Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                    <path d="M15 3.75V8.25h4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
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
