<!-- Navbar Start -->
<nav class="px-4 bg-white shadow navbar navbar-expand-lg navbar-light fixed-top py-lg-0 px-lg-5 z-1">
    <a class="navbar-brand d-inline-flex align-items-center" href="./">
        <img class="me-0" src="./assets/img/favicon.png" alt="Logo" height="50rem" />
        <h1 class="m-0 text-primary fw-bold">SIJAGUNG</h1>
    </a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="py-0 navbar-nav ms-auto">
            <a class="nav-item nav-link" href="./#home">Home</a>
            <a class="nav-item nav-link" href="/cara-budidaya-jagung">Cara Budidaya Jagung</a>
            <a class="nav-item nav-link" href="/kesehatan-jagung">Kesehatan Jagung</a>
            <a class="nav-item nav-link" href="/peta">Peta</a>
            <a class="nav-item nav-link" href="/kontak">Kontak</a>

            <!-- User Dropdown -->
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" id="userDropdown-menu" aria-labelledby="userDropdown">
                    @guest
                        <li><a class="dropdown-item" href="{{ route("login") }}">Login</a></li>
                    @else
                        <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route("logout") }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->
