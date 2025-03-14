<!doctype html>
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

        <meta name="robots" content="@yield("meta_robots", "index,follow")">

        <meta name="csrf-token" content="{{ csrf_token() }}">

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

        <link href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/css/glightbox.min.css" rel="stylesheet"
            integrity="sha512-T+KoG3fbDoSnlgEXFQqwcTC9AdkFIxhBlmoaFqYaIjq2ShhNwNao9AKaLUPMfwiBPL0ScxAtc+UYbHAgvd+sjQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Bootstrap CSS -->
        <link href={{ asset("assets/css/bootstrap.min.css") }} rel="stylesheet" />

        @stack("css")

        <link href={{ asset("assets/css/styleBS.css") }} rel="stylesheet" />

        <style>
            body {
                font-family: 'Hind Siliguri', serif;
            }

            body nav {
                font-family: 'Lato', serif;
            }
        </style>


        <!-- Scripts -->
        @vite(["resources/css/app.css", "resources/js/app.js"])
    </head>

    <body>

        @yield("content")



        <!-- Bootstrap Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/js/glightbox.min.js" integrity="sha512-RBWI5Qf647bcVhqbEnRoL4KuUT+Liz+oG5jtF+HP05Oa5088M9G0GxG0uoHR9cyq35VbjahcI+Hd1xwY8E1/Kg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $("#navbarCollapse .nav-item.nav-link").click(function(e) {
                $("#navbarCollapse").removeClass("show");
            });
            $(document).click(function(e) {
                if (!$(e.target).closest("#navbarCollapse").length) {
                    $("#navbarCollapse").removeClass("show");
                }
            });
        </script>

        @stack("javascript")

        <script src={{ asset("assets/js/js.js") }}></script>

    </body>

</html>
