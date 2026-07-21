@php
    $title = trim($__env->yieldContent('title')) ?: (
        request()->routeIs('dashboard') ? 'Dashboard' : (
            request()->is('folders*') ? 'Dossiers' : (
                request()->is('employees*') ? 'Employés' : (
                    request()->routeIs('abouts') ? 'À propos' : 'Application'
                )
            )
        )
    );

    $breadcrumbs = trim($__env->yieldContent('breadcrumbs'));

    $breadcrumbItems = $breadcrumbs !== ''
        ? null
        : (
            request()->routeIs('dashboard')
                ? [['label' => 'Accueil']]
                : (
                    request()->is('folders*')
                        ? [
                            ['label' => 'Accueil', 'url' => route('dashboard')],
                            ['label' => 'Dossiers'],
                        ]
                        : (
                            request()->is('employees*')
                                ? [
                                    ['label' => 'Accueil', 'url' => route('dashboard')],
                                    ['label' => 'Employés'],
                                ]
                                : (
                                    request()->routeIs('abouts')
                                        ? [
                                            ['label' => 'Accueil', 'url' => route('dashboard')],
                                            ['label' => 'À propos'],
                                        ]
                                        : [['label' => 'Accueil']]
                                )
                        )
                )
        );
@endphp

<header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur">
    <div class="flex flex-col gap-4 px-4 py-4 sm:px-6 lg:px-8">
        <div class="flex items-start gap-3 lg:hidden">
            <details class="group relative">
                <summary class="list-none">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl text-slate-500 transition-colors hover:bg-slate-100 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-sky-500/20">
                        <i class="bi bi-list text-lg"></i>
                    </span>
                </summary>

                <div class="fixed inset-0 z-40">
                    <div class="absolute inset-0 bg-slate-900/40"></div>
                    <div class="relative h-full w-80 max-w-[85vw] bg-white shadow-2xl shadow-slate-900/20">
                        <x-shell.sidebar />
                    </div>
                </div>
            </details>

            <div class="min-w-0 flex-1">
                @if($breadcrumbs !== '')
                    {!! $breadcrumbs !!}
                @elseif($breadcrumbItems)
                    <x-navigation.breadcrumb :items="$breadcrumbItems" />
                @endif

                <h1 class="mt-1 truncate text-lg font-semibold tracking-tight text-slate-900">
                    {{ $title }}
                </h1>
            </div>
        </div>

        <div class="hidden lg:flex lg:flex-col lg:gap-4">
            @if($breadcrumbs !== '')
                {!! $breadcrumbs !!}
            @elseif($breadcrumbItems)
                <x-navigation.breadcrumb :items="$breadcrumbItems" />
            @endif

            <div class="flex items-center justify-between gap-4">
                <div class="min-w-0">
                    <h1 class="truncate text-xl font-semibold tracking-tight text-slate-900">
                        {{ $title }}
                    </h1>
                </div>

                <div class="flex flex-1 items-center justify-end gap-3">
                    <div class="w-full max-w-md">
                        <x-shell.global-search />
                    </div>

                    <x-shell.notifications />
                    <x-shell.user-menu />
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-3 lg:hidden">
            <x-shell.global-search />

            <div class="flex items-center justify-end gap-2">
                <x-shell.notifications />
                <x-shell.user-menu />
            </div>
        </div>
    </div>
</header>
