@props([
    'label' => null,
    'name' => null,
    'required' => false,
    'disabled' => false,
])

<div class="space-y-2">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-slate-700">
            {{ $label }}
            @if($required)
                <span class="text-rose-600">*</span>
            @endif
        </label>
    @endif

    <select
        id="{{ $name }}"
        name="{{ $name }}"
        @required($required)
        @disabled($disabled)
        {{ $attributes->class('block w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 shadow-sm shadow-slate-100 transition-colors duration-150 focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/20') }}
    >
        {{ $slot }}
    </select>

    @isset($hint)
        <p class="text-sm text-slate-500">
            {{ $hint }}
        </p>
    @endisset

    @error($name)
        <p class="text-sm text-rose-600">
            {{ $message }}
        </p>
    @enderror
</div>
