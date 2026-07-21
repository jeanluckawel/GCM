@props([
    'name' => null,
    'value' => null,
    'placeholder' => 'Search',
])

<div class="relative">
    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
        <svg viewBox="0 0 20 20" fill="none" aria-hidden="true" class="h-4 w-4">
            <path d="M8.75 14.5a5.75 5.75 0 1 1 0-11.5a5.75 5.75 0 0 1 0 11.5Z" stroke="currentColor" stroke-width="1.5"/>
            <path d="M13.25 13.25L17 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
    </span>

    <input
        name="{{ $name }}"
        type="search"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->class('block w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-900 shadow-sm shadow-slate-100 transition-colors duration-150 placeholder:text-slate-400 focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/20') }}
    >
</div>
