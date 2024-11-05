<!-- partial:partials/_navbar.html -->
<nav class="navbar">
    <a class="sidebar-toggler" href="#">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img class="wd-30 ht-30 rounded-circle" src={{ Auth::user()->profile_photo_path ?? "https://via.placeholder.com/30x30" }} alt="profil">
                </a>
                <div class="p-0 dropdown-menu" aria-labelledby="profileDropdown">
                    <div class="px-5 py-3 d-flex flex-column align-items-center border-bottom">
                        <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle" src={{ Auth::user()->profile_photo_path ?? "https://via.placeholder.com/80x80" }} alt="Profil">
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">{{ Auth::user()->name }}</p>
                            <p class="tx-12 text-muted">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <ul class="p-1 list-unstyled">
                        <li class="py-2 dropdown-item">
                            <a class="text-body ms-0" href={{ route("profile.edit") }}>
                                <i class="me-2 icon-md" data-feather="user"></i>
                                <span>Profil</span>
                            </a>
                        </li>
                        <li class="py-2 dropdown-item">
                            <a class="text-body ms-0" href={{ route("profile.edit") }}>
                                <i class="me-2 icon-md" data-feather="edit"></i>
                                <span>Edit Profil</span>
                            </a>
                        </li>
                        <li class="py-2 dropdown-item">
                            <form method="POST" action="{{ route("logout") }}">
                                @csrf
                                <a class="text-body ms-0" href="{{ route("logout") }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="me-2 icon-md" data-feather="log-out"></i>
                                    <span>Keluar</span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- partial -->
