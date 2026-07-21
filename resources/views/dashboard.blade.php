@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <x-layouts.page-header
        title="Dashboard"
        description="Vue d’ensemble de l’activité documentaire et des dernières mises à jour."
    >
        <x-slot:breadcrumbs>
            <x-navigation.breadcrumb
                :items="[
                    ['label' => 'Accueil'],
                ]"
            />
        </x-slot:breadcrumbs>
    </x-layouts.page-header>

    <div class="mt-6 space-y-6">
        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <x-ui.stat-card label="Employés" :value="$employees">
                <x-slot:icon>
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-700">
                        <i class="bi bi-people-fill text-xl"></i>
                    </div>
                </x-slot:icon>
            </x-ui.stat-card>

            <x-ui.stat-card label="Dossiers" :value="$folders">
                <x-slot:icon>
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-700">
                        <i class="bi bi-folder-fill text-xl"></i>
                    </div>
                </x-slot:icon>
            </x-ui.stat-card>

            <x-ui.stat-card label="Documents" :value="$documents">
                <x-slot:icon>
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-700">
                        <i class="bi bi-file-earmark-text text-xl"></i>
                    </div>
                </x-slot:icon>
            </x-ui.stat-card>

            <x-ui.stat-card label="Départements" :value="9">
                <x-slot:icon>
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-50 text-rose-700">
                        <i class="bi bi-building text-xl"></i>
                    </div>
                </x-slot:icon>
            </x-ui.stat-card>
        </div>

        <div class="grid gap-6 xl:grid-cols-2">
            <x-ui.card title="Derniers employés" subtitle="Les derniers profils ajoutés dans le système.">
                <x-slot:header>
                    <x-ui.badge variant="neutral">
                        {{ $latestEmployees->count() }} enregistrés
                    </x-ui.badge>
                </x-slot:header>

                <x-table.responsive-table>
                    <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
                        <tr>
                            <th class="px-4 py-3">Matricule</th>
                            <th class="px-4 py-3">Nom</th>
                            <th class="px-4 py-3">Poste</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($latestEmployees as $employee)
                            <x-table.row>
                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-slate-900">
                                    {{ $employee->employee_number }}
                                </td>
                                <td class="px-4 py-4 text-sm text-slate-700">
                                    {{ $employee->full_name }}
                                </td>
                                <td class="px-4 py-4 text-sm text-slate-500">
                                    {{ $employee->position }}
                                </td>
                            </x-table.row>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-10 text-center text-sm text-slate-500">
                                    Aucun employé récent à afficher.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </x-table.responsive-table>
            </x-ui.card>

            <x-ui.card title="Derniers dossiers" subtitle="Les dossiers créés ou mis à jour récemment.">
                <x-slot:header>
                    <x-ui.badge variant="neutral">
                        {{ $latestFolders->count() }} enregistrés
                    </x-ui.badge>
                </x-slot:header>

                <x-table.responsive-table>
                    <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Employé</th>
                            <th class="px-4 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($latestFolders as $folder)
                            <x-table.row>
                                <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-slate-900">
                                    #{{ $folder->id }}
                                </td>
                                <td class="px-4 py-4 text-sm text-slate-700">
                                    {{ $folder->employee?->full_name }}
                                </td>
                                <td class="px-4 py-4 text-sm text-slate-500">
                                    {{ $folder->created_at->format('d/m/Y') }}
                                </td>
                            </x-table.row>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-10 text-center text-sm text-slate-500">
                                    Aucun dossier récent à afficher.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </x-table.responsive-table>
            </x-ui.card>
        </div>
    </div>
@endsection
