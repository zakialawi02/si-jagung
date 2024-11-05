<!doctype html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>@yield("title", config("app.name"))</title>
        <meta content="@yield("meta_description", "") name="description"">
        <meta name="author" content="Ahmad Zaki Alawi" />

        <link type="image/png" href="{{ asset("assets/img/favicon.png") }}" rel="shortcut icon">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        <!-- End fonts -->

        <!-- core:css -->
        <link href={{ asset("assets/vendors/core/core.css") }} rel="stylesheet">
        <!-- endinject -->

        <!-- inject:css icon -->
        <script src="https://unpkg.com/feather-icons"></script>
        <link href={{ asset("assets/vendors/flag-icon-css/css/flag-icon.min.css") }} rel="stylesheet">
        <!-- endinject -->

        <!-- Layout styles -->
        <link href={{ asset("assets/css/style.css") }} rel="stylesheet">
        <!-- End layout styles -->

        <!-- Favicon -->
        <link type="image/png" href={{ asset("assets/img/favicon.png") }} rel="icon">

        @stack("css")

        <!-- Scripts -->
        @vite(["resources/css/app.css", "resources/js/app.js"])
    </head>

    <body>
        <div class="main-wrapper">

            <!-- CONTENT HERE -->
            @yield("content")

        </div>

        <!-- core:js -->
        <script src={{ asset("assets/vendors/core/core.js") }}></script>
        <!-- endinject -->

        <!-- inject:js -->
        <script src={{ asset("assets/js/template.js") }}></script>
        <!-- endinject -->

        <!-- Custom js for this page -->
        <script src={{ asset("assets/js/dashboard-light.js") }}></script>
        <!-- End custom js for this page -->

        <!-- Script libraries -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

        @stack("javascript")

    </body>

</html>
