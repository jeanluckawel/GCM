@extends('layouts.app')

@section('title', 'Ajouter un document')

@section('content')
    @php
        $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
        $hasErrors = $errors->any();
    @endphp

    <x-layouts.page-header
        title="Ajouter un document"
        description="Sélectionnez un employé existant pour retrouver automatiquement son dossier et y déposer un nouveau fichier."
    >
        <x-slot:breadcrumbs>
            <x-navigation.breadcrumb
                :items="[
                    ['label' => 'Accueil', 'url' => route('dashboard')],
                    ['label' => 'Dossiers', 'url' => route('folder.index')],
                    ['label' => 'Ajouter un document'],
                ]"
            />
        </x-slot:breadcrumbs>

        <x-slot:actions>
            <x-ui.button href="{{ route('folder.index') }}" variant="ghost">
                Retour à la liste
            </x-ui.button>
        </x-slot:actions>
    </x-layouts.page-header>

    <div class="mt-6">
        @if($hasErrors)
            <div class="mb-6">
                <x-ui.alert variant="danger" title="Veuillez corriger les erreurs ci-dessous.">
                    <ul class="mt-2 list-disc space-y-1 pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </x-ui.alert>
            </div>
        @endif

        @if($employees->isEmpty())
            <div class="mb-6">
                <x-ui.alert variant="warning" title="Aucun dossier existant disponible.">
                    Aucun employé ne possède encore de dossier pour recevoir un document.
                </x-ui.alert>
            </div>
        @endif

        <x-ui.card
            title="Ajouter un document à un dossier existant"
            subtitle="Choisissez un employé qui possède déjà un dossier."
        >
            <form action="{{ route('folder.document.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <div class="grid gap-6 lg:grid-cols-2">
                    <x-ui.select
                        label="Employé"
                        name="employee_id"
                        required
                    >
                        <option value="">Sélectionner un employé</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}" @selected(old('employee_id', $selectedEmployeeId) == $employee->id)>
                                {{ $employee->full_name }} - {{ $employee->employee_number }}
                            </option>
                        @endforeach
                    </x-ui.select>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-sm font-semibold text-slate-900">
                            Dossier associé
                        </p>
                        <p class="mt-1 text-sm text-slate-500">
                            Le dossier existant de l’employé sera retrouvé automatiquement.
                        </p>
                        <p class="mt-2 text-xs text-slate-500">
                            Cette action n’ajoute pas de nouveau dossier, seulement un document.
                        </p>
                    </div>
                </div>

                <x-ui.input
                    label="Fichier"
                    name="file"
                    type="file"
                    required
                    accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx"
                    hint="Sélectionnez le document à déposer dans le dossier."
                />

                <div class="flex flex-wrap items-center gap-3 border-t border-slate-200 pt-6">
                    <x-ui.button type="submit" variant="primary" :disabled="$employees->isEmpty()">
                        <i class="bi bi-file-earmark-plus"></i>
                        Ajouter le document
                    </x-ui.button>

                    <x-ui.button href="{{ route('folder.index') }}" variant="ghost">
                        Annuler
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
@endsection
