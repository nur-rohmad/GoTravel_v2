<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/logo_GoTravel.png">

    {{-- csrf token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- TITLE -->
    <title>Go Travel </title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    {{-- fontawesome --}}
    <link id="style" href="/assets/plugins/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- STYLE CSS -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <!-- Plugins CSS -->
    <link href="/assets/css/plugins.css" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="/assets/css/icons.css" rel="stylesheet">

    <!-- INTERNAL Switcher css -->
    <link href="/assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="/assets/switcher/demo.css" rel="stylesheet">
    {{-- swertalert2 --}}
    <link rel="stylesheet" href="/assets/plugins/sweetalert2/sweetalert2.min.css">
    @yield('addcss')
</head>

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="/assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            <div class="app-header header sticky">
                <div class="container-fluid main-container">
                    <div class="d-flex">
                        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar"
                            href="javascript:void(0)"></a>
                        <!-- sidebar-toggle-->
                        <a class="logo-horizontal " href="/">
                            <img src="/assets/images/logo_GoTravel.png" style="width: 50px!important"
                                class="header-brand-img desktop-logo" alt="logo">
                            <img src="/assets/images/logo_GoTravel.png" style="width: 50px!important"
                                class="header-brand-img light-logo1" alt="logo">
                        </a>
                        <!-- LOGO -->
                        <div class="d-flex order-lg-2 ms-auto header-right-icons">
                            <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                                aria-controls="navbarSupportedContent-4" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                            </button>
                            <div class="navbar navbar-collapse responsive-navbar p-0">
                                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                    <div class="d-flex order-lg-2">
                                        <div class="d-flex">
                                            <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                                <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                                <span class="light-layout"><i class="fe fe-sun"></i></span>
                                            </a>
                                        </div>
                                        <!-- Theme-Layout -->
                                        <div class="dropdown d-flex profile-1">
                                            <a href="javascript:void(0)" data-bs-toggle="dropdown"
                                                class="nav-link leading-none d-flex">
                                                <img src="{{ asset('storage/'.auth()->user()->foto_profile) }}"
                                                    alt="profile-user" class="avatar  profile-user brround cover-image">
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <div class="drop-heading">
                                                    <div class="text-center">
                                                        <h5 class="text-dark mb-0 fs-14 fw-semibold">{{
                                                            auth()->user()->name }}</h5>
                                                        <small class="text-muted">{{ auth()->user()->role }}</small>
                                                    </div>
                                                </div>
                                                <div class="dropdown-divider m-0"></div>
                                                <a class="dropdown-item" href="/profile">
                                                    <i class="dropdown-icon fe fe-user"></i> Profile
                                                </a>
                                                <a href="/logouth" class="dropdown-item">
                                                    <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
            <div class="sticky">
                <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
                <div class="app-sidebar">
                    <div class="side-header">
                        <a class="header-brand1" href="index.html">
                            <img src="/assets/images/logo_GoTravel.png" style="width: 80px!important"
                                class="header-brand-img desktop-logo" alt="logo">
                            <img src="/assets/images/logo_GoTravel.png" style="width: 80px!important"
                                class="header-brand-img toggle-logo" alt="logo">
                            <img src="/assets/images/logo_GoTravel.png" style="width: 80px!important"
                                class="header-brand-img light-logo" alt="logo">
                            <img src="/assets/images/logo_GoTravel.png" style="width: 80px!important"
                                class="header-brand-img light-logo1" alt="logo">
                        </a>
                        <!-- LOGO -->
                    </div>
                    <div class="main-sidemenu">
                        <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                            </svg></div>
                        <ul class="side-menu">
                            <li class="sub-category">
                                <h3>Main</h3>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item has-link" data-bs-toggle="slide" href="/admin"><i
                                        class="side-menu__icon fe fe-home"></i><span
                                        class="side-menu__label">Dashboard</span></a>
                            </li>
                            <li class="sub-category">
                                <h3>Master Data</h3>
                            </li>
                            <li>
                                <a class="side-menu__item has-link {{ (request()->is('admin/wisata*') )? 'active' : '' }}"
                                    href="/admin/wisata"><i class="side-menu__icon fe fe-briefcase"></i><span
                                        class="side-menu__label">Wisata</span></a>
                            </li>
                            <li>
                                <a class="side-menu__item has-link {{ (request()->is('admin/open-trip*') )? 'active' : '' }}"
                                    href="/admin/open-trip"><i class="side-menu__icon fe fe-calendar"></i><span
                                        class="side-menu__label">Open
                                        Trip</span></a>
                            </li>
                            <li>
                                <a class="side-menu__item has-link {{ (request()->is('admin/chanel-pembayaran*') )? 'active' : '' }}"
                                    href="/admin/chanel-pembayaran"><i
                                        class="side-menu__icon fa fa-credit-card"></i><span
                                        class="side-menu__label">Chanel Pembayaran</span></a>
                            </li>
                            <li>
                                <a class="side-menu__item has-link {{ (request()->is('admin/booking*') )? 'active' : '' }}"
                                    href="/admin/booking"><i class="side-menu__icon icon icon-calendar"></i><span
                                        class="side-menu__label">Booking</span></a>
                            </li>
                            <li>
                                <a class="side-menu__item has-link {{ (request()->is('admin/laporan*') )? 'active' : '' }}"
                                    href="/admin/laporan"><i class="side-menu__icon fas fa-file"></i><span
                                        class="side-menu__label">Laporan</span></a>
                            </li>
                            <li>
                                <a class="side-menu__item has-link {{ (request()->is('admin/user*') )? 'active' : '' }}"
                                    href="/admin/user"><i class="side-menu__icon fas fa-users"></i><span
                                        class="side-menu__label">User</span></a>
                            </li>

                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                            </svg></div>
                    </div>
                </div>
            </div>
            <!--/APP-SIDEBAR-->

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">
                        @yield('main')
                    </div>
                    <!-- CONTAINER CLOSED -->
                </div>
            </div>
            <!--app-content closed-->
        </div>



        <!-- FOOTER -->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 text-center">
                        <span id="year"></span>. All
                        rights reserved.
                    </div>
                </div>
            </div>
        </footer>
        <!-- FOOTER CLOSED -->
    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JQUERY JS -->
    <script src="/assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="/assets/plugins/p-scroll/perfect-scrollbar.js"></script>
    <script src="/assets/plugins/p-scroll/pscroll.js"></script>
    <script src="/assets/plugins/p-scroll/pscroll-1.js"></script>
    <!-- SIDE-MENU JS -->
    <script src="/assets/plugins/sidemenu/sidemenu.js"></script>



    <!-- Color Theme js -->
    <script src="/assets/js/themeColors.js"></script>

    <!-- Sticky js -->
    <script src="/assets/js/sticky.js"></script>

    <!-- CUSTOM JS -->
    <script src="/assets/js/custom.js"></script>

    <!-- Custom-switcher -->
    <script src="/assets/js/custom-swicher.js"></script>

    <!-- Switcher js -->
    <script src="/assets/switcher/js/switcher.js"></script>
    {{-- swertalert2 --}}
    <script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- INTERNAL Notifications js -->
    <script src="/assets/plugins/notify/js/rainbow.js"></script>
    <script src="/assets/plugins/notify/js/jquery.growl.js"></script>
    <script src="/assets/plugins/notify/js/notifIt.js"></script>

    @yield('addscript')

</body>

</html>