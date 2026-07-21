@props([
    'alignment' => 'right',
])

<details {{ $attributes->class('group relative inline-block') }}>
    <summary class="list-none">
        {{ $trigger ?? $slot }}
    </summary>

    <div class="{{ $alignment === 'right' ? 'right-0' : 'left-0' }} absolute z-20 mt-2 min-w-48 rounded-xl border border-slate-200 bg-white p-2 shadow-lg shadow-slate-200/50">
        {{ $menu ?? '' }}
    </div>
</details>
