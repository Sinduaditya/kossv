<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>Kos - Sv2 | Homepage</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">


</head>

<body>
    <!-- ***** Header Area Start ***** -->
    @include('frontend.partials.navbar')
    <!-- ***** Header Area End ***** -->

    <!-- Start Content Kos -->
    @yield('content')
    <!-- End Content Kos -->


    <!-- footer -->
    @include('frontend.partials.footer')
    <!-- End Footer -->

    <!-- Scripts -->

    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
</body>

</html>
