@props([
    'items' => [],
])

<nav aria-label="Breadcrumb" {{ $attributes->class('text-sm') }}>
    <ol class="flex flex-wrap items-center gap-2 text-slate-500">
        @foreach($items as $index => $item)
            <li class="flex items-center gap-2">
                @if($index > 0)
                    <span class="text-slate-300">/</span>
                @endif

                @if(!empty($item['url']) && $index < count($items) - 1)
                    <a href="{{ $item['url'] }}" class="font-medium text-slate-600 transition-colors hover:text-slate-900">
                        {{ $item['label'] }}
                    </a>
                @else
                    <span class="font-medium text-slate-900">
                        {{ $item['label'] }}
                    </span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
