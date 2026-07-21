@props([
    'label' => null,
    'name' => null,
    'checked' => false,
    'disabled' => false,
])

<label class="flex items-center justify-between gap-4 rounded-xl border border-slate-200 bg-white px-4 py-3">
    <span class="text-sm font-medium text-slate-700">
        {{ $label ?? $slot }}
    </span>

    <input
        name="{{ $name }}"
        type="checkbox"
        value="1"
        role="switch"
        @checked($checked)
        @disabled($disabled)
        {{ $attributes->class('h-5 w-9 rounded-full border border-slate-300 bg-slate-200 text-slate-900 focus:ring-sky-500/20') }}
    >
</label>
