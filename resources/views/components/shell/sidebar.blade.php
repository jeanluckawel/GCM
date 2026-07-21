@php
    $items = [
        [
            'label' => 'Dashboard',
            'href' => route('dashboard'),
            'active' => request()->routeIs('dashboard'),
            'icon' => '<i class="bi bi-speedometer2"></i>',
        ],
        [
            'label' => 'Dossiers',
            'href' => route('folder.index'),
            'active' => request()->is('folders*'),
            'icon' => '<i class="bi bi-folder-fill"></i>',
        ],
        [
            'label' => 'Employés',
            'href' => route('employee.index'),
            'active' => request()->is('employees*'),
            'icon' => '<i class="bi bi-people-fill"></i>',
        ],
    ];

    $secondaryItems = [
        [
            'label' => 'Recherche',
            'href' => '#',
            'active' => false,
            'icon' => '<i class="bi bi-search"></i>',
        ],
        [
            'label' => 'Paramètres',
            'href' => '#',
            'active' => false,
            'icon' => '<i class="bi bi-gear-fill"></i>',
        ],
        [
            'label' => 'À propos',
            'href' => route('abouts'),
            'active' => request()->routeIs('abouts'),
            'icon' => '<i class="bi bi-info-circle"></i>',
        ],
    ];

    $user = auth()->user();
    $name = data_get($user, 'name', 'Administrateur');
    $role = data_get($user, 'role', 'Gestion des documents');
    $initials = collect(explode(' ', (string) $name))
        ->filter()
        ->take(2)
        ->map(fn ($part) => mb_substr($part, 0, 1))
        ->implode('');
    $initials = $initials !== '' ? mb_strtoupper($initials) : 'AD';
@endphp

<div class="flex h-full flex-col overflow-hidden bg-white">
    <div class="border-b border-slate-200 px-6 py-5">
        <div class="flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-900 text-white">
                <i class="bi bi-folder-fill text-lg"></i>
            </div>

            <div class="min-w-0">
                <p class="truncate text-sm font-semibold text-slate-900">
                    GCM
                </p>
                <p class="truncate text-xs text-slate-500">
                    Gestion documentaire
                </p>
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto px-3 py-4">
        <div class="space-y-6">
            <div>
                <p class="px-3 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                    Navigation principale
                </p>

                <div class="mt-2 space-y-1">
                    @foreach($items as $item)
                        <x-navigation.sidebar-item :href="$item['href']" :active="$item['active']">
                            <x-slot:icon>{!! $item['icon'] !!}</x-slot:icon>
                            {{ $item['label'] }}
                        </x-navigation.sidebar-item>
                    @endforeach
                </div>
            </div>

            <div>
                <p class="px-3 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                    Navigation secondaire
                </p>

                <div class="mt-2 space-y-1">
                    @foreach($secondaryItems as $item)
                        <x-navigation.sidebar-item :href="$item['href']" :active="$item['active']">
                            <x-slot:icon>{!! $item['icon'] !!}</x-slot:icon>
                            {{ $item['label'] }}
                        </x-navigation.sidebar-item>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="border-t border-slate-200 p-4">
        <div class="flex items-center gap-3 rounded-2xl bg-slate-50 p-3">
            <x-ui.avatar :initials="$initials" size="md" />

            <div class="min-w-0 flex-1">
                <p class="truncate text-sm font-medium text-slate-900">
                    {{ $name }}
                </p>
                <p class="truncate text-xs text-slate-500">
                    {{ $role }}
                </p>
            </div>

            <x-ui.button href="#" variant="ghost" size="sm">
                <i class="bi bi-box-arrow-right"></i>
            </x-ui.button>
        </div>
    </div>
</div>
