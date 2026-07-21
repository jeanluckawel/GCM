@props([
    'selected' => false,
])

<tr {{ $attributes->class([
    'transition-colors duration-150 hover:bg-slate-50',
    'bg-slate-50' => $selected,
]) }}>
    {{ $slot }}
</tr>
