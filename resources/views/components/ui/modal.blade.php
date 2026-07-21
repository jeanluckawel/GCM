@props([
    'open' => false,
    'title' => null,
])

@if($open)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50"></div>

        <div {{ $attributes->class('relative w-full max-w-2xl overflow-hidden rounded-2xl bg-white shadow-2xl shadow-slate-900/20') }}>
            @if($title || isset($header))
                <div class="flex items-start justify-between gap-4 border-b border-slate-200 px-6 py-4">
                    <div>
                        @if($title)
                            <h2 class="text-lg font-semibold tracking-tight text-slate-900">
                                {{ $title }}
                            </h2>
                        @endif

                        @isset($subtitle)
                            <p class="mt-1 text-sm text-slate-500">
                                {{ $subtitle }}
                            </p>
                        @endisset
                    </div>

                    @isset($header)
                        <div>
                            {{ $header }}
                        </div>
                    @endisset
                </div>
            @endif

            <div class="px-6 py-5">
                {{ $slot }}
            </div>

            @isset($footer)
                <div class="border-t border-slate-200 px-6 py-4">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </div>
@endif
