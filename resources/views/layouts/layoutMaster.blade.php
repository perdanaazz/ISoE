<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Test Full Stack Web Developer</title>

    <link rel="shortcut icon"
        href="data:image/png;base64,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">
    <link rel="stylesheet" href="{{ asset('template/assets/css/styles.min.css') }}" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    @yield('style')

</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="/" class="text-nowrap logo-img text-center mt-4">
                        <img src="data:image/png;base64,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"
                            class="img-fluid" width="30%" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>

                <nav class="sidebar-nav scroll-sidebar mt-4" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link active" href="/" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="hide-menu">Employee</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="body-wrapper">
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="https://ui-avatars.com/api/?name=Admin" alt="" width="35"
                                        height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <div class="container-fluid p-4">

                @yield('content')

            </div>
        </div>
    </div>

    <script src="{{ asset('template/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('template/assets/js/app.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('script')

</body>

</html>
