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
            <li class="nav-item  {{ Request::is("/") ? "active" : "" }}">
                <a class="nav-link" href="/">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Beranda</span>
                </a>
            </li>
            <li class="nav-item  {{ Request::is("dashboard") ? "active" : "" }}">
                <a class="nav-link" href="/dashboard">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dasbor</span>
                </a>
            </li>

            <li class="nav-item nav-category">Aplikasi web</li>

            <li class="nav-item {{ Request::is("blank") ? "active" : "" }}">
                <a class="nav-link" href="/blank">
                    <i class="link-icon" data-feather="layout"></i>
                    <span class="link-title">Halaman</span>
                </a>
            </li>

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
