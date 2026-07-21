<!doctype html>
<html lang="fr" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{ trim($__env->yieldContent('title')) !== '' ? trim($__env->yieldContent('title')) : config('app.name', 'Application') }}
    </title>
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script>
        tailwind = window.tailwind || {};
        tailwind.config = {
            theme: {
                extend: {},
            },
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('head')
</head>
<body class="h-screen overflow-hidden bg-slate-50 text-slate-900 antialiased">
<div class="flex h-screen overflow-hidden bg-slate-50">
    <aside class="hidden lg:block lg:w-72 lg:flex-shrink-0 lg:border-r lg:border-slate-200 lg:bg-white">
        <x-shell.sidebar />
    </aside>

    <div class="flex min-w-0 flex-1 flex-col overflow-hidden">
        <x-shell.navbar />

        <main class="flex-1 overflow-y-auto overflow-x-hidden">
            <div class="flex min-h-full flex-col">
                <x-layouts.content class="flex-1">
                    @yield('content')
                </x-layouts.content>

                <footer class="border-t border-slate-200 bg-white">
                    <div class="mx-auto w-full max-w-screen-2xl">
                        <x-shell.footer />
                    </div>
                </footer>
            </div>
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
