@extends('layouts.app')

@section('title', 'Employés')

@section('content')
    @php
        $employeeCount = $employees->count();
    @endphp

    <x-layouts.page-header
        title="Employés"
        description="Consultez la liste des employés enregistrés dans le système."
    >
        <x-slot:breadcrumbs>
            <x-navigation.breadcrumb
                :items="[
                    ['label' => 'Accueil', 'url' => route('dashboard')],
                    ['label' => 'Employés'],
                ]"
            />
        </x-slot:breadcrumbs>

        <x-slot:actions>
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <x-ui.button href="{{ route('employee.create') }}" variant="primary">
                    <i class="bi bi-plus-lg"></i>
                    Ajouter un employé
                </x-ui.button>

                <form action="{{ route('employee.index') }}" method="GET" class="flex flex-col gap-2 sm:flex-row sm:items-center">
                    <x-ui.search-input
                        name="search"
                        :value="$search"
                        placeholder="Rechercher un employé"
                        class="w-full sm:w-80"
                    />

                    <div class="flex items-center gap-2">
                        <x-ui.button type="submit" variant="primary">
                            <i class="bi bi-search"></i>
                            Rechercher
                        </x-ui.button>

                        @if($search !== '')
                            <x-ui.button href="{{ route('employee.index') }}" variant="ghost">
                                Réinitialiser
                            </x-ui.button>
                        @endif
                    </div>
                </form>
            </div>
        </x-slot:actions>
    </x-layouts.page-header>

    <div class="mt-6">
        @if(session('success'))
            <div class="mb-6">
                <x-ui.alert variant="success">
                    {{ session('success') }}
                </x-ui.alert>
            </div>
        @endif

        <x-ui.card
            title="Liste des employés"
            subtitle="Données affichées sans modification de la logique existante."
        >
            <x-slot:header>
                <x-ui.badge variant="neutral">
                    {{ $employeeCount }} employé(s)
                </x-ui.badge>
            </x-slot:header>

            @if($employeeCount > 0)
                <x-table.responsive-table>
                    <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Nom complet</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Téléphone</th>
                            <th class="px-4 py-3">Date création</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-200 bg-white">
                        @foreach($employees as $employee)
                            @php
                                $initials = collect(explode(' ', (string) $employee->full_name))
                                    ->filter()
                                    ->take(2)
                                    ->map(fn ($part) => mb_substr($part, 0, 1))
                                    ->implode('');
                                $initials = $initials !== '' ? mb_strtoupper($initials) : 'EM';
                            @endphp

                            <x-table.row>
                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-slate-900">
                                    #{{ $employee->id }}
                                </td>

                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <x-ui.avatar :initials="$initials" size="sm" />

                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-semibold text-slate-900">
                                                {{ $employee->full_name }}
                                            </p>
                                            <p class="text-xs text-slate-500">
                                                Employé
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-sm text-slate-700">
                                    {{ $employee->email ?? '-' }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-sm text-slate-700">
                                    {{ $employee->phone ?? '-' }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-sm text-slate-500">
                                    {{ $employee->created_at?->format('d/m/Y') }}
                                </td>
                            </x-table.row>
                        @endforeach
                    </tbody>
                </x-table.responsive-table>
            @else
                <x-ui.empty-state
                    :title="$search !== '' ? 'Aucun employé trouvé' : 'Aucun employé'"
                    :description="$search !== '' ? 'Aucun employé ne correspond à votre recherche.' : 'La liste des employés apparaîtra ici dès qu’un enregistrement sera disponible.'"
                />
            @endif
        </x-ui.card>
    </div>
@endsection
