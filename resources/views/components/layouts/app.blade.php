@props([
    'title' => config('app.name', 'Application'),
])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} | {{ config('app.name', 'Application') }}</title>
    @stack('head')
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
<div class="min-h-screen">
    @if(isset($sidebar) || isset($header))
        <div class="flex min-h-screen">
            @isset($sidebar)
                <aside class="hidden lg:flex lg:w-72 lg:flex-shrink-0">
                    <div class="flex w-full flex-col border-r border-slate-200 bg-white">
                        {{ $sidebar }}
                    </div>
                </aside>
            @endisset

            <div class="flex min-w-0 flex-1 flex-col">
                @isset($header)
                    <header class="border-b border-slate-200 bg-white">
                        {{ $header }}
                    </header>
                @endisset

                <main class="flex-1">
                    {{ $slot }}
                </main>

                @isset($footer)
                    <footer class="border-t border-slate-200 bg-white">
                        {{ $footer }}
                    </footer>
                @endisset
            </div>
        </div>
    @else
        <main>
            {{ $slot }}
        </main>
    @endif
</div>

@stack('scripts')
</body>
</html>
