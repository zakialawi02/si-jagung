<!doctype html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>@yield("title", config("app.name"))</title>
        <meta content="@yield("meta_description", "") name="description">
        <meta name="author" content="@yield("meta_author", "Ahmad Zaki Alawi")">

        <meta property="og:title" content="@yield("og_title", config("app.name"))" />
        <meta property="og:type" content="@yield("og_type", "website")" />
        <meta property="og:url" content="@yield("og_url", url()->current())" />
        <meta property="og:description" content="@yield("og_description", config("app.name"))" />
        <meta property="og:image" content="@yield("og_image", asset("assets/img/favicon.png"))" />

        <meta name="robots" content="@yield("meta_robots", "index,follow")">

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

        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">

        <!-- Favicon -->
        <link type="image/png" href={{ asset("assets/img/favicon.png") }} rel="icon">

        @include("components.dependencies._messageAlert");
        <style>
            p {
                margin-bottom: 10px;
            }

            @media (max-width: 768px) {
                #myTable {
                    display: block;
                    overflow-x: auto;
                    white-space: nowrap;
                }

                #myTable1 {
                    display: block;
                    overflow-x: auto;
                    white-space: nowrap;
                }

                #myTable2 {
                    display: block;
                    overflow-x: auto;
                    white-space: nowrap;
                }
            }
        </style>

        @stack("css")

        <!-- Scripts -->
        @vite(["resources/css/app.css", "resources/js/app.js"])
    </head>

    <body>
        <div class="main-wrapper">

            {{-- Sidebar --}}
            @include("components.admin._sidebar")

            <div class="page-wrapper">

                {{-- Navbar --}}
                @include("components.admin._navbar")

                <div class="page-content">

                    <!-- CONTENT HERE -->
                    @yield("content")

                </div>

                {{-- Footer --}}
                @include("components.admin._footer")

            </div>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>


        @stack("javascript")

    </body>

</html>
