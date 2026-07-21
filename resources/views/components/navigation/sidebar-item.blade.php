@props([
    'active' => false,
    'href' => '#',
])

<a href="{{ $href }}"
   {{ $attributes->class([
       'group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium transition-colors duration-150',
       'bg-slate-100 text-slate-900' => $active,
       'text-slate-600 hover:bg-slate-100 hover:text-slate-900' => ! $active,
   ]) }}>
    @isset($icon)
        <span class="inline-flex h-5 w-5 items-center justify-center text-slate-500 group-hover:text-slate-700">
            {{ $icon }}
        </span>
    @endisset

    <span class="truncate">
        {{ $slot }}
    </span>
</a>
