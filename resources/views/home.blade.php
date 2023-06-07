<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Go Travel</title>

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/logo_GoTravel.png">

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- STYLE CSS -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <!-- Plugins CSS -->
    <link href="/assets/css/plugins.css" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="/assets/css/icons.css" rel="stylesheet">

    {{-- csrf token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- INTERNAL Switcher css -->
    <link href="/assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="/assets/switcher/demo.css" rel="stylesheet">
    

</head>

<body class="app ltr landing-page horizontal">
    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="../assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            <div class="hor-header header">
                <div class="container main-container">
                    <div class="d-flex">
                        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar"
                            href="javascript:void(0)"></a>
                        <!-- sidebar-toggle-->
                        <a class="logo-horizontal " href="index.html">
                            <img src="/assets/images/logo_GoTravel.png" class="header-brand-img desktop-logo"
                                alt="logo" width="90px">
                            <img src="/assets/images/logo_GoTravel.png" class="header-brand-img light-logo1"
                                alt="logo" width="90px">
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
                                <div class="collapse navbar-collapse bg-white px-0" id="navbarSupportedContent-4">
                                    <!-- SEARCH -->
                                    <div class="header-nav-right p-5">
                                        <a href="register.html"
                                            class="btn ripple btn-min w-sm btn-outline-primary me-2 my-auto"
                                            target="_blank">New User
                                        </a>
                                        <a href="login.html" class="btn ripple btn-min w-sm btn-primary me-2 my-auto"
                                            target="_blank">Login
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /app-Header -->

            <div class="landing-top-header overflow-hidden">
                <div class="top sticky">
                    <!--APP-SIDEBAR-->
                    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
                    <div class="app-sidebar bg-transparent horizontal-main">
                        <div class="container">
                            <div class="row">
                                <div class="main-sidemenu navbar px-0">
                                    <a class="navbar-brand ps-0 d-none d-lg-block" href="index.html">
                                        <img alt="" class="logo-2" src="../assets/images/logo_GoTravel.png" width="80px">
                                        <img src="../assets/images/logo_GoTravel.png" class="logo-3" alt="logo" width="30px">
                                    </a>
                                    <ul class="side-menu">
                                       
                                        <li class="slide">
                                            <a class="side-menu__item" data-bs-toggle="slide" href="#Features"><span
                                                    class="side-menu__label">Features</span></a>
                                        </li>
                                        <li class="slide">
                                            <a class="side-menu__item" data-bs-toggle="slide" href="#About"><span
                                                    class="side-menu__label">About</span></a>
                                        </li>
                                        <li class="slide">
                                            <a class="side-menu__item" data-bs-toggle="slide" href="#Faqs"><span
                                                    class="side-menu__label">Faq's</span></a>
                                        </li>
                                        <li class="slide">
                                            <a class="side-menu__item" data-bs-toggle="slide" href="#Blog"><span
                                                    class="side-menu__label">Blog</span></a>
                                        </li>
                                        <li class="slide">
                                            <a class="side-menu__item" data-bs-toggle="slide" href="#Clients"><span
                                                    class="side-menu__label">Clients</span></a>
                                        </li>
                                        <li class="slide">
                                            <a class="side-menu__item" data-bs-toggle="slide" href="#Contact"><span
                                                    class="side-menu__label">Contact</span></a>
                                        </li>
                                       
                                    </ul>
                                    <div class="header-nav-right d-none d-lg-flex">
                                        <a href="/register"
                                            class="btn ripple btn-min w-sm btn-outline-primary me-2 my-auto d-lg-none d-xl-block d-block"
                                            target="_blank">New User
                                        </a>
                                        <a href="/login" class="btn ripple btn-min w-sm btn-primary me-2 my-auto d-lg-none d-xl-block d-block"
                                            target="_blank">Login
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/APP-SIDEBAR-->
                </div>
               
            </div>
            <div id="carousel-indicators4" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators carousel-indicators4">
                    <li data-bs-target="#carousel-indicators4" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carousel-indicators4" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carousel-indicators4" data-bs-slide-to="2"></li>
                    <li data-bs-target="#carousel-indicators4" data-bs-slide-to="3"></li>
                    <li data-bs-target="#carousel-indicators4" data-bs-slide-to="4"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100 br-5" alt="tes" src="{{ asset('storage/cover-wisata/TZy72Cs8ZFbmJknW27Zq9Ilng971PrtW2krnlkZQ.png') }}" data-bs-holder-rendered="true">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 br-5" alt="coba" src="/assets/images/storage/cover-wisata/5.jpg" data-bs-holder-rendered="true">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 br-5" alt="tes" src="/assets/images/storage/cover-wisata/6.jpg" data-bs-holder-rendered="true">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 br-5" alt="sasa" src="/assets/images/storage/cover-wisata/7.jpg" data-bs-holder-rendered="true">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 br-5" alt="sdasd" src="../assets/images/media/8.jpg" data-bs-holder-rendered="true">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JQUERY JS -->
    <script src="/assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- COUNTERS JS-->
    {{-- <script src="/assets/plugins/counters/counterup.min.js"></script>
    <script src="/assets/plugins/counters/waypoints.min.js"></script>
    <script src="/assets/plugins/counters/counters-1.js"></script> --}}

    <!-- Perfect SCROLLBAR JS-->
    <script src="/assets/plugins/owl-carousel/owl.carousel.js"></script>
    {{-- <script src="/assets/plugins/company-slider/slider.js"></script> --}}

    <!-- Star Rating Js-->
    {{-- <script src="/assets/plugins/rating/jquery-rate-picker.js"></script>
    <script src="/assets/plugins/rating/rating-picker.js"></script> --}}

    <!-- Star Rating-1 Js-->
    {{-- <script src="/assets/plugins/ratings-2/jquery.star-rating.js"></script>
    <script src="/assets/plugins/ratings-2/star-rating.js"></script> --}}

    <!-- Sticky js -->
    <script src="/assets/js/sticky.js"></script>

    <!-- CUSTOM JS -->
    <script src="/assets/js/landing.js"></script>

</body>

</html>
