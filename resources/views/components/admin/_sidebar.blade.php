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
            <li class="nav-item {{ Request::is("/") ? "active" : "" }}">
                <a class="nav-link" href="/">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Beranda</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is("dashboard") ? "active" : "" }}">
                <a class="nav-link" href="/dashboard">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dasbor</span>
                </a>
            </li>

            <li class="nav-item nav-category">Utama</li>

            <li class="nav-item {{ Request::is("dashboard/lahan*") ? "active" : "" }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#lahan" role="button" aria-expanded="false" aria-controls="lahan">
                    <i class="link-icon" data-feather="layers"></i>
                    <span class="link-title">Lahan/Kebun Petani</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="{{ Request::is("dashboard/lahan*") ? "show" : "" }} collapse" id="lahan">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is("dashboard/lahan") ? "active" : "" }}" href={{ route("admin.lahan.index") }}>Semua data</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is("dashboard/lahan/data-masuk") ? "active" : "" }}" href={{ route("admin.lahan.indexNew") }}>Perminatan/Data baru</a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- <li class="nav-item {{ Request::is("blank") ? "active" : "" }}">
                <a class="nav-link" href="/blank">
                    <i class="link-icon" data-feather="layout"></i>
                    <span class="link-title">Halaman</span>
                </a>
            </li> --}}

            <li class="nav-item nav-category">Kelola</li>

            <li class="nav-item {{ Request::is("dashboard/users*") ? "active" : "" }}">
                <a class="nav-link" href={{ route("admin.users.index") }}>
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Pengguna</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- partial -->
