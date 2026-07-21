@props([
    'title' => null,
    'subtitle' => null,
])

<section {{ $attributes->class('overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm shadow-slate-100') }}>
    @if($title || isset($header))
        <header class="flex items-start justify-between gap-4 border-b border-slate-200 px-5 py-4">
            <div class="min-w-0">
                @if($title)
                    <h2 class="truncate text-base font-semibold tracking-tight text-slate-900">
                        {{ $title }}
                    </h2>
                @endif

                @if($subtitle)
                    <p class="mt-1 text-sm text-slate-500">
                        {{ $subtitle }}
                    </p>
                @endif
            </div>

            @isset($header)
                <div class="shrink-0">
                    {{ $header }}
                </div>
            @endisset
        </header>
    @endif

    <div class="p-5">
        {{ $slot }}
    </div>

    @isset($footer)
        <footer class="border-t border-slate-200 px-5 py-4">
            {{ $footer }}
        </footer>
    @endisset
</section>
