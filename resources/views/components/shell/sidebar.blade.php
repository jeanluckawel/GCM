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
    $role = data_get($user, 'role', 'Gestion documentaire');

    $initials = collect(explode(' ', (string) $name))
        ->filter()
        ->take(2)
        ->map(fn ($part) => mb_substr($part, 0, 1))
        ->implode('');

    $initials = $initials !== '' ? mb_strtoupper($initials) : 'AD';
@endphp

<div class="flex h-full flex-col overflow-hidden bg-[#cf663e] text-[#f7e7e1]">

    <!-- Logo -->
    <div class="border-b border-[#d88362] px-6 py-5">

        <div class="flex items-center gap-4">

            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#eecabc] shadow-lg">
                <i class="bi bi-folder-fill text-xl text-[#cf663e]"></i>
            </div>

            <div>
                <h1 class="text-lg font-bold text-white">
                    GCM
                </h1>

                <p class="text-xs text-[#f7e7e1]/80">
                    Gestion documentaire
                </p>
            </div>

        </div>

    </div>

    <!-- Navigation -->
    <div class="flex-1 overflow-y-auto px-4 py-6">

        <div class="space-y-8">

            <!-- Navigation principale -->
            <div>

                <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-[0.2em] text-[#eecabc]">
                    Navigation principale
                </p>

                <div class="space-y-2">

                    @foreach($items as $item)

                        <a href="{{ $item['href'] }}"
                           class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-200
                           {{ $item['active']
                                ? 'bg-[#eecabc] text-[#cf663e] shadow-lg'
                                : 'text-[#f7e7e1] hover:bg-[#d88362] hover:translate-x-1' }}">

                            <span class="text-lg">
                                {!! $item['icon'] !!}
                            </span>

                            <span class="font-medium">
                                {{ $item['label'] }}
                            </span>

                        </a>

                    @endforeach

                </div>

            </div>

            <!-- Navigation secondaire -->
            <div>

                <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-[0.2em] text-[#eecabc]">
                    Navigation secondaire
                </p>

                <div class="space-y-2">

                    @foreach($secondaryItems as $item)

                        <a href="{{ $item['href'] }}"
                           class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-200
                           {{ $item['active']
                                ? 'bg-[#eecabc] text-[#cf663e] shadow-lg'
                                : 'text-[#f7e7e1] hover:bg-[#d88362] hover:translate-x-1' }}">

                            <span class="text-lg">
                                {!! $item['icon'] !!}
                            </span>

                            <span class="font-medium">
                                {{ $item['label'] }}
                            </span>

                        </a>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

    <!-- Utilisateur -->
    <div class="border-t border-[#d88362] p-4">

        <div class="flex items-center gap-3 rounded-2xl bg-[#d88362]/30 p-3 backdrop-blur">

            <x-ui.avatar
                :initials="$initials"
                size="md"
            />

            <div class="min-w-0 flex-1">

                <p class="truncate text-sm font-semibold text-white">
                    {{ $name }}
                </p>

                <p class="truncate text-xs text-[#f7e7e1]/80">
                    {{ $role }}
                </p>

            </div>

            <a href="#"
               class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#eecabc] text-[#cf663e] transition hover:bg-[#e9bcaa]">

                <i class="bi bi-box-arrow-right"></i>

            </a>

        </div>

    </div>

</div>

