@props([
    'label' => null,
    'value' => null,
    'trend' => null,
])

<div {{ $attributes->class('rounded-2xl border border-slate-200 bg-white p-5 shadow-sm shadow-slate-100') }}>
    <div class="flex items-start justify-between gap-4">
        <div class="min-w-0">
            @if($label)
                <p class="text-sm font-medium text-slate-500">
                    {{ $label }}
                </p>
            @endif

            @if($value)
                <p class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">
                    {{ $value }}
                </p>
            @endif
        </div>

        @isset($icon)
            <div class="shrink-0 text-slate-400">
                {{ $icon }}
            </div>
        @endisset
    </div>

    @if($trend)
        <p class="mt-4 text-sm text-slate-500">
            {{ $trend }}
        </p>
    @endif
</div>
