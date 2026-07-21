@props([
    'brand' => config('app.name', 'Application'),
])

<div class="flex h-full flex-col">
    <div class="border-b border-slate-200 px-6 py-5">
        <div class="text-sm font-semibold tracking-wide text-slate-900">
            {{ $brand }}
        </div>
        @isset($subtitle)
            <div class="mt-1 text-sm text-slate-500">
                {{ $subtitle }}
            </div>
        @endisset
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4">
        {{ $slot }}
    </nav>

    @isset($footer)
        <div class="border-t border-slate-200 px-6 py-4">
            {{ $footer }}
        </div>
    @endisset
</div>
