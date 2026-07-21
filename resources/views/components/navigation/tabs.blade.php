@props([
    'items' => [],
])

<div {{ $attributes->class('border-b border-slate-200') }}>
    <nav class="-mb-px flex flex-wrap gap-2" aria-label="Tabs">
        @foreach($items as $item)
            @php $active = (bool)($item['active'] ?? false); @endphp
            <a href="{{ $item['url'] ?? '#' }}"
               class="{{ $active ? 'border-slate-900 text-slate-900' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700' }} border-b-2 px-3 py-2 text-sm font-medium transition-colors duration-150">
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>
</div>
