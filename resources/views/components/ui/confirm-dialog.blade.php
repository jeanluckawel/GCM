@props([
    'open' => false,
    'title' => 'Confirm action',
    'message' => null,
])

@if($open)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50"></div>

        <div {{ $attributes->class('relative w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl shadow-slate-900/20') }}>
            <div class="border-b border-slate-200 px-6 py-4">
                <h2 class="text-lg font-semibold tracking-tight text-slate-900">
                    {{ $title }}
                </h2>
            </div>

            <div class="px-6 py-5">
                @if($message)
                    <p class="text-sm leading-6 text-slate-600">
                        {{ $message }}
                    </p>
                @endif

                {{ $slot }}
            </div>
        </div>
    </div>
@endif
