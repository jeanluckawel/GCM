@extends('layouts.app')

@section('title', 'Dossier #'.$folder->id)

@section('content')
    <x-layouts.page-header
        :title="'Dossier #'.$folder->id"
        description="Consultez les informations du dossier et les documents associés."
    >
        <x-slot:breadcrumbs>
            <x-navigation.breadcrumb
                :items="[
                    ['label' => 'Accueil', 'url' => route('dashboard')],
                    ['label' => 'Dossiers', 'url' => route('folder.index')],
                    ['label' => 'Dossier #'.$folder->id],
                ]"
            />
        </x-slot:breadcrumbs>

        <x-slot:actions>
            <x-ui.button href="{{ route('folder.index') }}" variant="secondary">
                <i class="bi bi-arrow-left"></i>
                Retour
            </x-ui.button>

            <x-ui.button href="{{ route('folder.document.create', ['employee_id' => $folder->employee_id]) }}" variant="primary">
                <i class="bi bi-plus-lg"></i>
                Ajouter un document
            </x-ui.button>
        </x-slot:actions>
    </x-layouts.page-header>

    <div class="mt-6 grid gap-6 xl:grid-cols-[minmax(0,1fr)_minmax(0,1.6fr)]">
        @if(session('success'))
            <div class="xl:col-span-2">
                <x-ui.alert variant="success">
                    {{ session('success') }}
                </x-ui.alert>
            </div>
        @endif

        <div class="space-y-6">
            <x-ui.card title="Informations du dossier" subtitle="Résumé du dossier sélectionné.">
                <div class="space-y-4">
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-sm font-medium text-slate-500">
                            Employé responsable
                        </p>
                        <p class="mt-1 text-base font-semibold text-slate-900">
                            {{ $folder->employee?->full_name ?? 'Aucun employé' }}
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="rounded-2xl border border-slate-200 px-4 py-3">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                Identifiant
                            </p>
                            <p class="mt-1 text-sm font-semibold text-slate-900">
                                #{{ $folder->id }}
                            </p>
                        </div>

                        <div class="rounded-2xl border border-slate-200 px-4 py-3">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                Documents
                            </p>
                            <p class="mt-1 text-sm font-semibold text-slate-900">
                                {{ $folder->documents->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </x-ui.card>
        </div>

        <div>
            <x-ui.card title="Documents" subtitle="Liste des documents contenus dans ce dossier.">
                <x-slot:header>
                    <x-ui.badge variant="neutral">
                        {{ $folder->documents->count() }} élément(s)
                    </x-ui.badge>
                </x-slot:header>

                @if($folder->documents->count() > 0)
                    <div class="space-y-3">
                        @foreach($folder->documents as $document)
                            <div class="rounded-2xl border border-slate-200 bg-white p-4 transition-colors duration-150 hover:border-slate-300 hover:bg-slate-50">
                                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-start gap-3">
                                            <x-documents.file-icon :type="$document->file_type" :label="mb_substr((string) $document->document_type, 0, 3)" />

                                            <div class="min-w-0">
                                                <div class="flex flex-wrap items-center gap-2">
                                                    <h3 class="truncate text-sm font-semibold text-slate-900">
                                                        {{ $document->title }}
                                                    </h3>
                                                    <x-ui.badge variant="primary">
                                                        {{ $document->document_type }}
                                                    </x-ui.badge>
                                                </div>

                                                <p class="mt-1 text-sm text-slate-500">
                                                    {{ $document->file_name }}
                                                </p>

                                                <div class="mt-3 flex flex-wrap items-center gap-3 text-xs text-slate-500">
                                                    <span>{{ $document->file_type }}</span>
                                                    <span>•</span>
                                                    <span>{{ number_format($document->file_size / 1024, 2) }} KB</span>
                                                    <span>•</span>
                                                    <span>#{{ $document->id }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <x-table.actions>
                                        <x-ui.button href="{{ asset('storage/'.$document->file_path) }}" variant="secondary" size="sm">
                                            <i class="bi bi-eye"></i>
                                            Voir
                                        </x-ui.button>

                                        <form action="#" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')

                                            <x-ui.button type="submit" variant="danger" size="sm" onclick="return confirm('Supprimer ce document ?')">
                                                <i class="bi bi-trash"></i>
                                                Supprimer
                                            </x-ui.button>
                                        </form>
                                    </x-table.actions>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <x-documents.empty-folder
                        title="Aucun document disponible"
                        description="Ce dossier ne contient encore aucun document."
                    />
                @endif
            </x-ui.card>
        </div>
    </div>
@endsection
