@extends('layouts.app')

@section('title', 'Nouveau dossier employé')

@section('content')
    @php
        $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
        $hasErrors = $errors->any();
    @endphp

    <x-layouts.page-header
        title="Nouveau dossier employé"
        description="Créez un dossier pour un employé qui n’en possède pas encore."
    >
        <x-slot:breadcrumbs>
            <x-navigation.breadcrumb
                :items="[
                    ['label' => 'Accueil', 'url' => route('dashboard')],
                    ['label' => 'Dossiers', 'url' => route('folder.index')],
                    ['label' => 'Ajouter un dossier'],
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
                <x-ui.alert variant="warning" title="Aucun employé disponible.">
                    Tous les employés disposent déjà d’un dossier.
                </x-ui.alert>
            </div>
        @endif

        <x-ui.card
            title="Créer un dossier"
            subtitle="Sélectionnez un employé disponible pour ouvrir son dossier."
        >
            <form action="{{ route('folder.store') }}" method="POST" class="space-y-8">
                @csrf

                <x-ui.select
                    label="Employé"
                    name="employee_id"
                    required
                >
                    <option value="">Sélectionner un employé</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" @selected(old('employee_id') == $employee->id)>
                            {{ $employee->full_name }} - {{ $employee->employee_number }}
                        </option>
                    @endforeach
                </x-ui.select>

                <div class="flex flex-wrap items-center gap-3 border-t border-slate-200 pt-6">
                    <x-ui.button type="submit" variant="primary" :disabled="$employees->isEmpty()">
                        <i class="bi bi-folder-plus"></i>
                        Créer le dossier
                    </x-ui.button>

                    <x-ui.button href="{{ route('folder.index') }}" variant="ghost">
                        Annuler
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
@endsection
