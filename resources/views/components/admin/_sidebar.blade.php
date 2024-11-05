<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <a class="sidebar-brand" href="/dashboard">
            Dasbor
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Utama</li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dasbor</span>
                </a>
            </li>

            <li class="nav-item nav-category">Aplikasi web</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Email</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="emails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/email/inbox.html">Kotak Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/email/read.html">Baca</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/email/compose.html">Tulis</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="blank">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Kalender</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="blank">
                    <i class="link-icon" data-feather="layout"></i>
                    <span class="link-title">Halaman</span>
                </a>
            </li>

            <li class="nav-item nav-category">Kelola</li>
            <li class="nav-item">
                <a class="nav-link" href={{ route("admin.users.index") }}>
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Pengguna</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- partial -->
