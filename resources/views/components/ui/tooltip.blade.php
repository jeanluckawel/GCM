<span {{ $attributes->class('group relative inline-flex') }}>
    {{ $trigger ?? $slot }}

    @isset($content)
        <span class="pointer-events-none absolute left-1/2 top-full z-20 mt-2 hidden -translate-x-1/2 whitespace-nowrap rounded-lg bg-slate-900 px-3 py-2 text-xs font-medium text-white shadow-lg shadow-slate-900/20 group-hover:block group-focus-within:block">
            {{ $content }}
        </span>
    @endisset
</span>
