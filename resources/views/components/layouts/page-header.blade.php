@props([
    'title' => null,
    'description' => null,
])

<div {{ $attributes->class('space-y-4 border-b border-slate-200 bg-white px-4 py-6 sm:px-6 lg:px-8') }}>
    @isset($breadcrumbs)
        <div>
            {{ $breadcrumbs }}
        </div>
    @endisset

    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div class="min-w-0">
            @if($title)
                <h1 class="text-2xl font-semibold tracking-tight text-slate-900">
                    {{ $title }}
                </h1>
            @endif

            @if($description)
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
                    {{ $description }}
                </p>
            @endif
        </div>

        @isset($actions)
            <div class="flex flex-wrap items-center gap-2">
                {{ $actions }}
            </div>
        @endisset
    </div>
</div>
