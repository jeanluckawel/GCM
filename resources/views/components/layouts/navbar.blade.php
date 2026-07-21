@props([
    'title' => null,
])

<div class="flex items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
    <div class="min-w-0">
        @if($title)
            <h1 class="truncate text-lg font-semibold tracking-tight text-slate-900">
                {{ $title }}
            </h1>
        @endif

        @isset($subtitle)
            <p class="mt-1 text-sm text-slate-500">
                {{ $subtitle }}
            </p>
        @endisset
    </div>

    @isset($actions)
        <div class="flex flex-wrap items-center justify-end gap-2">
            {{ $actions }}
        </div>
    @endisset
</div>
