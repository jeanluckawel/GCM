@extends('layouts.app')

@section('content')

    <div class="row p-lg-5">

        <div class="col-12">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h3 class="card-title">
                        <i class="bi bi-folder-fill me-2"></i>
                        Mes Dossiers
                    </h3>


                    <div class="d-flex gap-2">


                        <div class="input-group input-group-sm" style="width: 200px;">

                            <input type="text"
                                   class="form-control"
                                   placeholder="Search...">

                            <button class="btn btn-outline-secondary">
                                <i class="bi bi-search"></i>
                            </button>

                        </div>



                        <a href="#" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-lg"></i>
                            Add
                        </a>

                    </div>

                </div>


                <div class="card-body">


                    <div class="row">


                        @php
                            $colors = [
                                '#2596be',
                                '#dc3545',
                                '#198754',
                                '#ffc107'
                            ];
                        @endphp



                        @foreach($folders as $folder)


                            @php
                                $color = $colors[$folder->id % count($colors)];
                            @endphp



                            <div class="col-12 col-sm-6 col-md-3">


                                <a href="{{ route('folders.show', $folder->id) }}" class="text-decoration-none text-dark">

                                    <div class="info-box">

            <span class="info-box-icon shadow-sm"
                  style="background-color: {{ $color }};color:white">

                <i class="bi bi-folder-fill"></i>

            </span>


                                        <div class="info-box-content">

                <span class="info-box-text">
                    {{ $folder->employee?->full_name ?? 'Aucun employé' }}
                </span>


                                            <span class="info-box-number">
                    Dossier #{{ $folder->id }}
                </span>

                                        </div>


                                    </div>

                                </a>

                            </div>



                        @endforeach



                    </div>


                </div>


            </div>


        </div>


    </div>


@endsection
