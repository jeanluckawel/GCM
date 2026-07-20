@extends('layouts.app')


@section('content')


    <div class="container-fluid p-4">


        <div class="row">


            {{-- Employees --}}
            <div class="col-md-3">

                <div class="info-box shadow-sm">

                <span class="info-box-icon text-bg-primary">

                    <i class="bi bi-people-fill"></i>

                </span>


                    <div class="info-box-content">

                    <span class="info-box-text">
                        Employés
                    </span>

                        <span class="info-box-number">
                        {{ $employees }}
                    </span>

                    </div>

                </div>

            </div>



            {{-- Dossiers --}}
            <div class="col-md-3">

                <div class="info-box shadow-sm">


                <span class="info-box-icon text-bg-success">

                    <i class="bi bi-folder-fill"></i>

                </span>


                    <div class="info-box-content">

                    <span class="info-box-text">
                        Dossiers
                    </span>


                        <span class="info-box-number">
                        {{ $folders }}
                    </span>

                    </div>


                </div>

            </div>




            {{-- Documents --}}
            <div class="col-md-3">


                <div class="info-box shadow-sm">


                <span class="info-box-icon text-bg-warning">

                    <i class="bi bi-file-earmark-text"></i>

                </span>


                    <div class="info-box-content">

                    <span class="info-box-text">
                        Documents
                    </span>


                        <span class="info-box-number">
                        {{ $documents }}
                    </span>


                    </div>


                </div>


            </div>




            {{-- Departments --}}
            <div class="col-md-3">


                <div class="info-box shadow-sm">


                <span class="info-box-icon text-bg-danger">

                    <i class="bi bi-building"></i>

                </span>


                    <div class="info-box-content">


                    <span class="info-box-text">
                        Départements
                    </span>


                        <span class="info-box-number">
{{--                        {{ $departments }}--}} 9
                    </span>


                    </div>


                </div>


            </div>



        </div>




        <div class="row mt-4">


            {{-- Derniers employés --}}
            <div class="col-md-6">


                <div class="card shadow-sm">


                    <div class="card-header">

                        <h5 class="mb-0">

                            <i class="bi bi-people me-2"></i>

                            Derniers employés

                        </h5>

                    </div>



                    <div class="card-body p-0">


                        <table class="table table-hover mb-0">


                            <thead>

                            <tr>

                                <th>Matricule</th>

                                <th>Nom</th>

                                <th>Poste</th>

                            </tr>

                            </thead>



                            <tbody>


                            @foreach($latestEmployees as $employee)

                                <tr>

                                    <td>
                                        {{ $employee->employee_number }}
                                    </td>


                                    <td>

                                        {{ $employee->full_name }}

                                    </td>


                                    <td>

                                        {{ $employee->position }}

                                    </td>


                                </tr>

                            @endforeach


                            </tbody>


                        </table>


                    </div>


                </div>


            </div>





            {{-- Derniers dossiers --}}
            <div class="col-md-6">


                <div class="card shadow-sm">


                    <div class="card-header">


                        <h5 class="mb-0">

                            <i class="bi bi-folder me-2"></i>

                            Derniers dossiers

                        </h5>


                    </div>




                    <div class="card-body p-0">


                        <table class="table table-hover mb-0">


                            <thead>

                            <tr>

                                <th>#</th>

                                <th>Employé</th>

                                <th>Date</th>

                            </tr>


                            </thead>



                            <tbody>


                            @foreach($latestFolders as $folder)


                                <tr>

                                    <td>
                                        #{{ $folder->id }}
                                    </td>


                                    <td>

                                        {{ $folder->employee?->full_name }}

                                    </td>


                                    <td>

                                        {{ $folder->created_at->format('d/m/Y') }}

                                    </td>


                                </tr>


                            @endforeach


                            </tbody>


                        </table>


                    </div>


                </div>


            </div>



        </div>



    </div>


@endsection
