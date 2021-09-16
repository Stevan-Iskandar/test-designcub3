<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $title }}</title>
    <meta name="domain" content="{{ env('APP_URL') }}">
    <meta name="token" content="{{ csrf_token() }}">

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="{{ env('ASSET_URL') }}/vendor/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ env('ASSET_URL') }}/css/sb-admin-2.min.css">

    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ env('ASSET_URL') }}/css/custom-style.css">
    @stack('css')
</head>

<body class="bg-gradient-primary">

    <div class="container">

        @yield('content')

    </div>

    <div class="loading" style="display: none;">
        <div class="loading-container text-center">
            <i class="fas fa-5x fa-spinner fa-spin"></i>
            <h1>Loading...</h1>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ env('ASSET_URL') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ env('ASSET_URL') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ env('ASSET_URL') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ env('ASSET_URL') }}/js/sb-admin-2.min.js"></script>

    <!-- Custom Scripts -->
    @stack('js')
</body>
</html>
