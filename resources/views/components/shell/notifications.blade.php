<x-navigation.dropdown {{ $attributes->class('relative') }}>
    <x-slot:trigger>
        <span class="relative inline-flex h-10 w-10 items-center justify-center rounded-xl text-slate-500 transition-colors hover:bg-slate-100 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-sky-500/20">
            <span class="sr-only">Notifications</span>
            <i class="bi bi-bell text-lg"></i>
            <span class="absolute right-1 top-1 inline-flex h-2.5 w-2.5 rounded-full bg-rose-500"></span>
        </span>
    </x-slot:trigger>

    <x-slot:menu>
        <div class="px-3 py-2">
            <p class="text-sm font-semibold text-slate-900">Notifications</p>
            <p class="mt-1 text-xs text-slate-500">Aucune notification active pour le moment.</p>
        </div>

        <div class="my-2 h-px bg-slate-200"></div>

        <div class="space-y-1">
            <div class="rounded-lg px-3 py-2 text-sm text-slate-600 hover:bg-slate-50">
                Nouveau dossier ajouté
            </div>
            <div class="rounded-lg px-3 py-2 text-sm text-slate-600 hover:bg-slate-50">
                Nouveau document importé
            </div>
        </div>
    </x-slot:menu>
</x-navigation.dropdown>
