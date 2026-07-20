@extends('layouts.app')

@section('content')

    <div class="container-fluid p-4">

        <div class="card shadow-sm">

            {{-- Header --}}
            <div class="card-header d-flex justify-content-between align-items-center">

                <h3 class="card-title mb-0">
                    <i class="bi bi-folder-fill me-2 text-primary"></i>
                    Dossier #{{ $folder->id }}
                </h3>



            </div>



            {{-- Body --}}
            <div class="card-body">

                <div class="row g-3">


                    {{-- Employé --}}
                    <div class="col-md-4">

                        <div class="info-box shadow-sm">

            <span class="info-box-icon text-bg-primary">
                <i class="bi bi-person-fill"></i>
            </span>


                            <div class="info-box-content">

                <span class="info-box-text">
                    Employé responsable
                </span>


                                <span class="info-box-number">
                    {{ $folder->employee?->full_name ?? 'Aucun employé' }}
                </span>


                            </div>


                        </div>

                    </div>





                </div>

                <hr>


                {{-- Documents --}}
                {{-- Documents --}}
                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h5 class="mb-0">
                        <i class="bi bi-files me-2"></i>
                        Documents
                    </h5>


                    <button class="btn btn-primary btn-sm">

                        <i class="bi bi-plus-lg"></i>
                        Ajouter

                    </button>

                </div>



                @if($folder->documents->count() > 0)

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover align-middle">

                            <thead class="table-light">

                            <tr>

                                <th>#</th>
                                <th>Titre</th>
                                <th>Type</th>
                                <th>Fichier</th>
                                <th>Format</th>
                                <th>Taille</th>
                                <th class="text-center">Actions</th>

                            </tr>

                            </thead>


                            <tbody>

                            @foreach($folder->documents as $document)

                                <tr>

                                    <td>
                                        {{ $document->id }}
                                    </td>


                                    <td>
                                        <i class="bi bi-file-earmark-text me-1"></i>
                                        {{ $document->title }}
                                    </td>


                                    <td>
                        <span class="badge text-bg-primary">
                            {{ $document->document_type }}
                        </span>
                                    </td>


                                    <td>
                                        {{ $document->file_name }}
                                    </td>


                                    <td>
                                        {{ $document->file_type }}
                                    </td>


                                    <td>
                                        {{ number_format($document->file_size / 1024, 2) }} KB
                                    </td>


                                    <td class="text-center">


                                        {{-- Voir --}}
                                        <a href="{{ asset('storage/'.$document->file_path) }}"
                                           target="_blank"
                                           class="btn btn-success btn-sm">

                                            <i class="bi bi-eye"></i>

                                        </a>



                                        {{-- Delete --}}
                                        <form action="#"
                                              method="POST"
                                              class="d-inline">

                                            @csrf
                                            @method('DELETE')


                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Supprimer ce document ?')">

                                                <i class="bi bi-trash"></i>

                                            </button>


                                        </form>


                                    </td>


                                </tr>


                            @endforeach


                            </tbody>


                        </table>


                    </div>


                @else


                    <div class="border rounded p-5 text-center">

                        <i class="bi bi-file-earmark-x fs-1 text-secondary"></i>


                        <p class="text-muted mt-3 mb-0">
                            Aucun document disponible pour ce dossier
                        </p>

                    </div>


                @endif


            </div>


        </div>

    </div>


@endsection
