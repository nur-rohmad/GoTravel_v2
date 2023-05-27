<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Go Travel merupakan website penyedia informasi tempat-tempat wisata yang indah yang ada di Indonesia">
    <meta name="author" content="PT Go-Travel Indonesia">
    <meta name="keywords" content="wisata, travel, liburan">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/logo_GoTravel.png">

    <!-- TITLE -->
    <title>Update Password - GoTravel</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- STYLE CSS -->
     <link href="/assets/css/style.css" rel="stylesheet">

	<!-- Plugins CSS -->
    <link href="/assets/css/plugins.css" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="/assets/css/icons.css" rel="stylesheet">

    <!-- INTERNAL Switcher css -->
    <link href="/assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="/assets/switcher/demo.css" rel="stylesheet">

</head>

<body class="app sidebar-mini ltr login-img">

    <!-- BACKGROUND-IMAGE -->
    <div class="">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="/assets/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">
                <!-- Theme-Layout -->

                {{-- <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto mt-7 mb-2">
                    <div class="text-center">
                        <a href="index.html"><img src="/assets/images/logo_GoTravel.png" style="width: 200px!important" class="header-brand-img" alt=""></a>
                    </div>
                </div> --}}

                <div class="container">
                    <div class="wrap-login100 p-6 col-md-6 mx-auto">
                        <form class="login100-form validate-form"  method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <span class="login100-form-title pb-5">
                                Update Password
                            </span>
                                <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                    <input class="input100 form-control ms-0 @error('email') is-invalid  @enderror" name="email" type="email" placeholder="Email" value="{{old('email')}}">
                                    <span class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                    </span>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                    <input class="input100 form-control ms-0 @error('password') is-invalid  @enderror" name="password" type="password" placeholder="Password">
                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                    </a>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                    <input class="input100 form-control ms-0 @error('password_confirmation') is-invalid  @enderror" name="password_confirmation" type="password" placeholder="Konfirmasi Password">
                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                    </a>
                                    @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="container-login100-form-btn">
                                    <button type="submit" class="login100-form-btn btn-primary">
                                            Reset Password
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="/assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="/assets/js/show-password.min.js"></script>

    <!-- GENERATE OTP JS -->
    <script src="/assets/js/generate-otp.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="/assets/plugins/p-scroll/perfect-scrollbar.js"></script>

    <!-- Color Theme js -->
    <script src="/assets/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="/assets/js/custom.js"></script>

    <!-- Custom-switcher -->
    <script src="/assets/js/custom-swicher.js"></script>

    <!-- Switcher js -->
    <script src="/assets/switcher/js/switcher.js"></script>

</body>

</html>