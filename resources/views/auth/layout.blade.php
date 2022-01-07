<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Title -->
    <title>{{ $title }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Social tags -->
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.ico') }}" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,600,600i,700,700i" rel="stylesheet" />
    <!-- Bootstrap Css -->
    <link href="{{ asset('vendor/bootstrap/css') }}/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css') }}/custom.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="login-page" class="pt-5">
        <div class="pt-sm-5">
            <div class="container">
                <div class="row d-flex justify-content-center" style="padding-top: 30px;padding-bottom: 80px;">
                    <div class="col-lg-5">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="{{ asset('vendor') }}/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>