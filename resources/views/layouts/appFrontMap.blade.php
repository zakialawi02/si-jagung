<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>@yield("title", config("app.name"))</title>

        <meta name="description" content="@yield("meta_description", "")">
        <meta name="author" content="@yield("meta_author", "Ahmad Zaki Alawi")">
        <meta name="keywords" content="@yield("meta_keywords", "")">

        <meta property="og:title" content="@yield("og_title", config("app.name"))" />
        <meta property="og:type" content="@yield("og_type", "website")" />
        <meta property="og:url" content="@yield("og_url", url()->current())" />
        <meta property="og:description" content="@yield("og_description", config("app.name"))" />
        <meta property="og:image" content="@yield("og_image", asset("assets/img/favicon.png"))" />

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link type="image/png" href="{{ asset("assets/img/favicon.png") }}" rel="shortcut icon">

        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <!-- Google Web Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Hind+Siliguri:wght@300;400;500;600;700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
            rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href={{ asset("assets/css/bootstrap.min.css") }} rel="stylesheet" />

        <!-- open layers css -->
        <link href="https://cdn.jsdelivr.net/npm/ol@v10.2.1/ol.css" rel="stylesheet">
        <link href={{ asset("assets/css/styleBS.css") }} rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">

        <style>
            body {
                font-family: 'Hind Siliguri', serif;
            }

            body nav {
                font-family: 'Lato', serif;
            }

            .ol-tooltip {
                position: relative;
                background: rgba(0, 0, 0, 0.5);
                border-radius: 4px;
                color: white;
                padding: 4px 8px;
                opacity: 0.7;
                white-space: nowrap;
                font-size: 12px;
                cursor: default;
                user-select: none;
            }

            .ol-tooltip-measure {
                opacity: 1;
                font-weight: bold;
            }

            .ol-tooltip-static {
                background-color: #ffcc33;
                color: black;
                border: 1px solid white;
            }

            .ol-tooltip-measure:before,
            .ol-tooltip-static:before {
                border-top: 6px solid rgba(0, 0, 0, 0.5);
                border-right: 6px solid transparent;
                border-left: 6px solid transparent;
                content: "";
                position: absolute;
                bottom: -6px;
                margin-left: -7px;
                left: 50%;
            }

            .ol-tooltip-static:before {
                border-top-color: #ffcc33;
            }
        </style>

        @stack("css")

        <!-- Scripts -->
        @vite(["resources/css/app.css", "resources/js/app.js"])
    </head>

    <body>

        @include("components.front._navbar")

        @yield("content")



        <!-- Bootstrap Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <script>
            $(".navbar-toggler").click(function(e) {
                $("#navbarCollapse").toggleClass("collapse");
                $("#navbarCollapse").toggleClass("show");
            });
            $("#navbarCollapse .nav-item.nav-link").click(function(e) {
                $("#navbarCollapse").removeClass("collapse");
            });
            $(document).click(function(e) {
                if (!$(e.target).closest("#navbarCollapse").length) {
                    $("#navbarCollapse").removeClass("show");
                }
            });
            $("#userDropdown").click(function(e) {
                $("#userDropdown-menu").toggleClass("show");
            });

            $("#layerControlBtn").click(function(e) {
                $("#layerControl").toggleClass("show");
            });
            $(".btn-layerControl-close").click(function(e) {
                $("#layerControl").toggleClass("show");
            });

            $("#drawerControlBtn").click(function(e) {
                $("#drawerControl").toggleClass("show");
            });
            $(".btn-drawerControl-close").click(function(e) {
                $("#drawerControl").toggleClass("show");
            });

            $("#legendBtn , #legendPopupClose").click(function(e) {
                $("#legendSection").toggleClass("d-none");
            });
        </script>

        <!-- open layers js -->
        <script src="https://cdn.jsdelivr.net/npm/ol@v10.2.1/dist/ol.js"></script>

        <!-- proj4js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.11.0/proj4.min.js" integrity="sha512-JfEOeAU2TD7AtE3xJPSBwBFCxURVqQCysNBwOnNhEJS9LgTHTWGSyYd11JUBOaJ+xVHPaA0ZhLin365CapD8EQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>

        @stack("javascript")

        <script src={{ asset("assets/js/map.js") }}></script>

    </body>

</html>
