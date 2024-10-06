<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>GIS Leaflet Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="GIS Leaflet Project">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Sweet Alert -->
    <link type="text/css" href="{{ asset('sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">

    <!-- Font Awesome ICON -->
    <script src="https://kit.fontawesome.com/091b217840.js" crossorigin="anonymous"></script>

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('css/volt.css') }}" rel="stylesheet">

    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->
    @yield('styles')
</head>

<body>
    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
        <a class="navbar-brand me-lg-5" href="../../index.html">
            <img class="navbar-brand-dark" src="{{ asset('img/light.svg') }}" alt="Volt logo" />
        </a>
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
        <div class="sidebar-inner px-4 pt-3">
            <div
                class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
                <div class="d-flex align-items-center">
                    <div class="avatar-lg me-4">
                        <img src="{{ isset($userImage) ? $userImage : '' }} "
                            class="card-img-top rounded-circle border-white" alt="Bonnie Green">
                    </div>
                    <div class="d-block">
                        <h2 class="h6 mb-0">{{ $userGlobal->name }}</h2>
                        <div class="">{{ $userGlobal->email }}</div>
                    </div>
                </div>
                <div class="collapse-close d-md-none">
                    <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                        aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!--SIDEBAR NAV-->
            <ul class="nav flex-column pt-3 pt-md-0">
                <li class="nav-item">
                    <a href="/" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <img src="{{ asset('img/light.svg') }}" height="20" width="20" alt="SIG Logo">
                        </span>
                        <span class="mt-1 ms-1 sidebar-text">GIS Location</span>
                    </a>
                </li>

                <!--SIDEBAR MENU-->
                <li class="nav-item {{ Request::routeIs(['welcome', 'dashboard']) ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <i class="fa-solid fa-barcode"></i>
                        </span>
                        <span class="ms-2 sidebar-text">Cari Produk</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs(['products.*']) ? 'active' : '' }}">
                    <a href="{{ route('products.index') }}" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <i class="fa-solid fa-box"></i>
                        </span>
                        <span class="ms-2 sidebar-text">Produk</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs(['transactions.*']) ? 'active' : '' }}">
                    <a href="{{ route('transactions.index') }}" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <i class="fa-solid fa-money-bill"></i>
                        </span>
                        <span class="ms-2 sidebar-text">Transaksi</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs(['shops.*']) ? 'active' : '' }}">
                    <a href="{{ route('shops.index') }}" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <i class="fa-solid fa-shop"></i>
                        </span>
                        <span class="ms-2 sidebar-text">Toko</span>
                    </a>
                </li>

                <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>
            </ul>
            <!--HEADER NAV-->

        </div>
    </nav>

    <main class="content">

        <!--HEADER NAV-->
        <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
            <div class="container-fluid px-0">
                <div class="d-flex justify-content-end w-100" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle pt-1 px-0 d-flex" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path
                                        d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
                                </svg> --}}
                                <div class="media d-flex align-items-center">
                                    <img class="avatar rounded-circle" alt="Image placeholder"
                                        src="{{ isset($userImage) ? $userImage : '' }} }}">
                                    <div class="media-body ms-2 text-dark align-items-center d-none d-xl-block">
                                        <div class="mb-0 font-small fw-bold text-gray-900">{{ $userGlobal->name }}
                                        </div>
                                        <div class="mb-0 font-small text-gray-900">{{ $userGlobal->email }}</div>
                                    </div>
                                </div>
                            </a>
                            @if (Route::has('logout'))
                            <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                                <form action="{{ (route('logout')) ?? '#' }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex align-items-center">
                                        <svg class="dropdown-icon text-danger me-2" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--HEADER NAV-->

        <!--DISPLAY CONTENT-->
        <div class="row">
            @yield('content')
        </div>
        <!--DISPLAY CONTENT-->

        <footer class="bg-white rounded shadow p-3 mb-4 mt-4">
            <div class="row">
                <div class="col-12 col-md-8 mb-md-0">
                    <p class="mb-0 text-center text-lg-start">© 2024-<span class="current-year"></span> <a
                            class="text-primary fw-normal" href="https://themesberg.com"
                            target="_blank">Project SIG Lanjut [Sistem Informasi UNTAN]</a></p>
                </div>
                <div class="col-12 col-md-4 text-center text-lg-start">
                    <!-- List -->
                    <ul class="list-inline list-group-flush list-group-borderless text-md-end mb-0">
                        <li class="list-inline-item px-0 px-sm-2">
                            <a href="https://github.com/rhagilsetiawan/product-loc"><i class="fa-brands fa-github"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </main>

    <!-- Core -->
    <script src="{{ asset('vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Sweet Alerts 2 -->
    <script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    @stack('scripts')
    <!-- Volt JS -->
    <script src="{{ asset('js/volt.js') }}"></script>
</body>

</html>
