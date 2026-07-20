<!doctype html>
<html lang="fr">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>
        Gecamine
    </title>


    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">


    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">


</head>



<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">


<div class="app-wrapper">



    {{-- Header --}}
    @include('layouts.header')



    {{-- Sidebar --}}
    @include('layouts.sidebar')




    {{-- Content --}}
    <main class="app-main">


        @yield('content')


    </main>




    {{-- Footer --}}
    @include('layouts.footer')



</div>




{{-- Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js">
</script>



{{-- AdminLTE JS --}}
<script src="{{ asset('js/adminlte.js') }}">
</script>


</body>


</html>
