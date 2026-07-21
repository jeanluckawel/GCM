@extends('layouts.app')

@section('title', 'Ajouter un employé')

@section('content')
    @php
        $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
        $hasErrors = $errors->any();
    @endphp

    <x-layouts.page-header
        title="Ajouter un employé"
        description="Renseignez les informations disponibles pour créer un nouveau profil employé."
    >
        <x-slot:breadcrumbs>
            <x-navigation.breadcrumb
                :items="[
                    ['label' => 'Accueil', 'url' => route('dashboard')],
                    ['label' => 'Employés', 'url' => route('employee.index')],
                    ['label' => 'Ajouter un employé'],
                ]"
            />
        </x-slot:breadcrumbs>

        <x-slot:actions>
            <x-ui.button href="{{ route('employee.index') }}" variant="ghost">
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

        <x-ui.card
            title="Informations de l'employé"
            subtitle="Les champs marqués d'un astérisque sont obligatoires."
        >
            <form action="{{ route('employee.store') }}" method="POST" class="space-y-8">
                @csrf

                <div class="grid gap-6 lg:grid-cols-2">
                    <x-ui.input
                        label="Matricule"
                        name="employee_number"
                        placeholder="EMP001"
                        value="{{ old('employee_number') }}"
                        required
                    />

                    <x-ui.select label="Statut" name="status" required>
                        <option value="active" @selected(old('status', 'active') === 'active')>Actif</option>
                        <option value="retired" @selected(old('status') === 'retired')>Retraité</option>
                        <option value="suspended" @selected(old('status') === 'suspended')>Suspendu</option>
                    </x-ui.select>
                </div>

                <div class="grid gap-6 lg:grid-cols-3">
                    <x-ui.input
                        label="Prénom"
                        name="first_name"
                        placeholder="Prénom"
                        value="{{ old('first_name') }}"
                        required
                    />

                    <x-ui.input
                        label="Second prénom"
                        name="middle_name"
                        placeholder="Optionnel"
                        value="{{ old('middle_name') }}"
                    />

                    <x-ui.input
                        label="Nom"
                        name="last_name"
                        placeholder="Nom"
                        value="{{ old('last_name') }}"
                        required
                    />
                </div>

                <div class="grid gap-6 lg:grid-cols-3">
                    <x-ui.select label="Genre" name="gender" required>
                        <option value="" @selected(old('gender') === null || old('gender') === '')>Sélectionner</option>
                        <option value="male" @selected(old('gender') === 'male')>Masculin</option>
                        <option value="female" @selected(old('gender') === 'female')>Féminin</option>
                    </x-ui.select>

                    <x-ui.input
                        label="Date de naissance"
                        name="birth_date"
                        type="date"
                        value="{{ old('birth_date') }}"
                        required
                    />

                    <x-ui.input
                        label="Date d'embauche"
                        name="hire_date"
                        type="date"
                        value="{{ old('hire_date') }}"
                    />
                </div>

                <div class="grid gap-6 lg:grid-cols-3">
                    <x-ui.input
                        label="Poste"
                        name="position"
                        placeholder="Responsable RH"
                        value="{{ old('position') }}"
                    />

                    <x-ui.input
                        label="Grade"
                        name="grade"
                        placeholder="A1"
                        value="{{ old('grade') }}"
                    />

                    <x-ui.input
                        label="Département"
                        name="department"
                        placeholder="Ressources humaines"
                        value="{{ old('department') }}"
                    />
                </div>

                <div class="grid gap-6 lg:grid-cols-2">
                    <x-ui.input
                        label="Téléphone"
                        name="phone"
                        type="tel"
                        placeholder="+243........."
                        value="{{ old('phone') }}"
                    />

                    <x-ui.input
                        label="Email"
                        name="email"
                        type="email"
                        placeholder="emailexemple@entreprise.com"
                        value="{{ old('email') }}"
                    />
                </div>

                <div class="grid gap-6 lg:grid-cols-2">
                    <x-ui.input
                        label="Date de départ"
                        name="retirement_date"
                        type="date"
                        value="{{ old('retirement_date') }}"
                    />

                    <div></div>
                </div>

                <x-ui.textarea
                    label="Adresse"
                    name="address"
                    rows="4"
                    placeholder="Adresse complète"
                    :value="old('address')"
                />

                <div class="flex flex-wrap items-center gap-3 border-t border-slate-200 pt-6">
                    <x-ui.button type="submit" variant="primary">
                        <i class="bi bi-check2-circle"></i>
                        Créer l'employé
                    </x-ui.button>

                    <x-ui.button href="{{ route('employee.index') }}" variant="ghost">
                        Annuler
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
@endsection
