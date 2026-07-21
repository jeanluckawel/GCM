@extends('layouts.app')

@section('title', 'Dossiers')

@section('content')
    <x-layouts.page-header
        title="Dossiers"
        description="Parcourez les dossiers des employés et ouvrez rapidement un espace documentaire."
    >
        <x-slot:breadcrumbs>
            <x-navigation.breadcrumb
                :items="[
                    ['label' => 'Accueil', 'url' => route('dashboard')],
                    ['label' => 'Dossiers'],
                ]"
            />
        </x-slot:breadcrumbs>

        <x-slot:actions>
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <x-ui.button href="{{ route('folder.create') }}" variant="primary">
                    <i class="bi bi-plus-lg"></i>
                    Nouveau dossier employé
                </x-ui.button>

                <x-ui.button href="{{ route('folder.document.create') }}" variant="secondary">
                    <i class="bi bi-file-earmark-plus"></i>
                    Ajouter un document à un dossier existant
                </x-ui.button>

                <form action="{{ route('folder.index') }}" method="GET" class="flex flex-col gap-2 sm:flex-row sm:items-center">
                    <x-ui.search-input
                        name="search"
                        :value="$search"
                        placeholder="Rechercher un dossier"
                        class="w-full sm:w-80"
                    />

                    <div class="flex items-center gap-2">
                        <x-ui.button type="submit" variant="primary">
                            <i class="bi bi-search"></i>
                            Rechercher
                        </x-ui.button>

                        @if($search !== '')
                            <x-ui.button href="{{ route('folder.index') }}" variant="ghost">
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

        @if($folders->count() > 0)
            <div class="mb-4 flex items-center justify-between gap-3">
                <x-ui.badge variant="neutral">
                    {{ $folders->count() }} dossier(s)
                </x-ui.badge>

                @if($search !== '')
                    <x-ui.badge variant="primary">
                        Recherche: "{{ $search }}"
                    </x-ui.badge>
                @endif
            </div>

            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
                @foreach($folders as $folder)
                    <x-documents.folder-card
                        :href="route('folders.show', $folder->id)"
                        :title="$folder->employee?->full_name ?? 'Aucun employé'"
                        :meta="'Dossier #'.$folder->id"
                    />
                @endforeach
            </div>
        @else
            <x-documents.empty-folder
                :title="$search !== '' ? 'Aucun dossier trouvé' : 'Aucun dossier disponible'"
                :description="$search !== '' ? 'Aucun dossier ne correspond à votre recherche.' : 'Les dossiers apparaîtront ici dès qu’ils seront créés.'"
            />
        @endif
    </div>
@endsection
