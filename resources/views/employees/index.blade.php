@extends('layouts.app')

@section('content')

    <div class="container-fluid p-4">


        <div class="card shadow-sm">


            {{-- Header --}}
            <div class="card-header d-flex justify-content-between align-items-center">

                <h3 class="card-title mb-0">

                    <i class="bi bi-people-fill me-2 text-primary"></i>
                    Liste des employés

                </h3>





            </div>



            {{-- Body --}}
            <div class="card-body">


                <div class="table-responsive">


                    <table class="table table-bordered table-hover align-middle">


                        <thead class="table-light">

                        <tr>

                            <th>#</th>
                            <th>Nom complet</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Date création</th>

                        </tr>

                        </thead>



                        <tbody>


                        @foreach($employees as $employee)


                            <tr>


                                <td>
                                    {{ $employee->id }}
                                </td>


                                <td>

                                    <i class="bi bi-person-fill me-1"></i>

                                    {{ $employee->full_name }}

                                </td>


                                <td>

                                    {{ $employee->email ?? '-' }}

                                </td>


                                <td>

                                    {{ $employee->phone ?? '-' }}

                                </td>


                                <td>

                                    {{ $employee->created_at?->format('d/m/Y') }}

                                </td>





                            </tr>


                        @endforeach


                        </tbody>


                    </table>


                </div>


            </div>


        </div>


    </div>

@endsection
