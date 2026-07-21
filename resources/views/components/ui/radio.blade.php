@props([
    'label' => null,
    'name' => null,
    'value' => null,
    'checked' => false,
    'disabled' => false,
])

<label class="flex items-start gap-3 text-sm text-slate-700">
    <input
        name="{{ $name }}"
        type="radio"
        value="{{ $value }}"
        @checked($checked)
        @disabled($disabled)
        {{ $attributes->class('mt-1 h-4 w-4 border-slate-300 text-slate-900 focus:ring-sky-500/20') }}
    >

    <span class="leading-6">
        {{ $label ?? $slot }}
    </span>
</label>
