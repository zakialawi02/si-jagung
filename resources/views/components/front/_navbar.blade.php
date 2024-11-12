<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-lg-0 px-lg-5 z-3 bg-white px-4 shadow">
    <a class="navbar-brand d-inline-flex align-items-center" href="./">
        <img class="me-0" src="./assets/img/favicon.png" alt="Logo" height="50rem" />
        <h1 class="text-primary fw-bold m-0">SIJAGUNG</h1>
    </a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse justify-content-between collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a class="nav-item nav-link {{ Request::is("/") ? "active" : "" }}" href="./#home">Home</a>
            <a class="nav-item nav-link {{ Request::is("teknik-budidaya-jagung") ? "active" : "" }}" href="/teknik-budidaya-jagung">Tekni Budidaya Jagung</a>
            <a class="nav-item nav-link {{ Request::is("kesehatan-jagung") ? "active" : "" }}" href="/kesehatan-jagung">Kesehatan Jagung</a>
            <a class="nav-item nav-link {{ Request::is("daftar-lahan") ? "active" : "" }}" href="/daftar-lahan">Data Kebun</a>
            <a class="nav-item nav-link {{ Request::is("peta") ? "active" : "" }}" href="/peta">Peta</a>
            <a class="nav-item nav-link {{ Request::is("kontak") ? "active" : "" }}" href="/kontak">Kontak</a>

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
