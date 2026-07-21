@php
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

<x-navigation.dropdown {{ $attributes->class('relative') }}>
    <x-slot:trigger>
        <span class="flex items-center gap-3 rounded-xl px-2 py-1.5 text-left transition-colors hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-sky-500/20">
            <x-ui.avatar :initials="$initials" size="sm" />

            <span class="hidden min-w-0 flex-col text-left md:flex">
                <span class="truncate text-sm font-medium text-slate-900">
                    {{ $name }}
                </span>
                <span class="truncate text-xs text-slate-500">
                    {{ $role }}
                </span>
            </span>

            <i class="bi bi-chevron-down hidden text-xs text-slate-400 md:inline"></i>
        </span>
    </x-slot:trigger>

    <x-slot:menu>
        <div class="px-3 py-3">
            <div class="flex items-center gap-3">
                <x-ui.avatar :initials="$initials" size="md" />
                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold text-slate-900">
                        {{ $name }}
                    </p>
                    <p class="truncate text-xs text-slate-500">
                        {{ $role }}
                    </p>
                </div>
            </div>
        </div>

        <div class="my-2 h-px bg-slate-200"></div>

        <div class="space-y-1">
            <a href="#" class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-slate-900">
                Profil
            </a>
            <a href="#" class="block rounded-lg px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-slate-900">
                Paramètres
            </a>
            <a href="#" class="block rounded-lg px-3 py-2 text-sm text-rose-600 hover:bg-rose-50">
                Déconnexion
            </a>
        </div>
    </x-slot:menu>
</x-navigation.dropdown>
