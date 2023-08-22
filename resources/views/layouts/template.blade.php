<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="img/favicon.png" type="image/png" />
    <title>Hoodie Station</title>
    <link rel="icon" href="{{asset('storage/img/logo.png')}}" type="image">

    <link rel="stylesheet" href="{{asset ('user/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{asset ('user/vendors/linericon/style.css') }}" />
    <link rel="stylesheet" href="{{asset ('user/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{asset ('user/css/themify-icons.css') }}" />
    <link rel="stylesheet" href="{{asset ('user/css/flaticon.css') }}" />
    <link rel="stylesheet" href="{{asset ('user/vendors/owl-carousel/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{asset ('user/vendors/lightbox/simpleLightbox.css') }}" />
    <link rel="stylesheet" href="{{asset ('user/vendors/nice-select/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{asset ('user/vendors/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{asset ('user/vendors/jquery-ui/jquery-ui.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{asset ('user/css/style.css') }}" />
    <link rel="stylesheet" href="{{asset ('user/css/responsive.css') }}" />
</head>
<body>

    <header class="header_area">
        <div class="main_menu">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light w-100">

                    <a class="navbar-brand logo_h" href="/">
                        <img src="{{asset ('storage/img/hitam.jpg') }}" width="75%" alt="" />
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
                        <div class="row w-100 mr-0">
                            <div class="col-lg-7 pr-0">
                                <ul class="nav navbar-nav center_nav pull-right">
                                    <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ url('/home') }}">Home</a>
                                    </li>
                                    <li class="nav-item {{ Request::is('shop') ? 'active' : '' }}">
                                        <a href="{{ url('/shop') }}" class="nav-link" role="button" aria-haspopup="true" aria-expanded="false">Shop</a>
                                    <li class="nav-item">
                            </div>
                            <div class="col-lg-5 pr-0">
                                <ul class="nav navbar-nav navbar-right right_nav pull-right">
                                    <li class="nav-item">
                                        <a href="/cart" class="icons">
                                            <i class="ti-shopping-cart"> </i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/invoice/1" class="icons">
                                            <i class="bi bi-clipboard-minus"></i>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav navbar-nav center_nav pull-right">
                                    <li class="nav-item submenu dropdown">
                                        <a class="nav-link dropdown-toggle" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti-user"> Akun Saya</i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                            <li><a class="dropdown-item" href="/profile"><i class="bi bi-person"></i> Profil</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <form action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Keluar</button>
                                                </form>
                                        </ul>
                                    </li>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <script src="{{asset ('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{asset ('js/popper.js') }}"></script>
    <script src="{{asset ('js/bootstrap.min.js') }}"></script>
    <script src="{{asset ('js/stellar.js') }}"></script>
    <script src="{{asset ('vendors/lightbox/simpleLightbox.min.js') }}"></script>
    <script src="{{asset ('vendors/nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{asset ('vendors/isotope/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{asset ('vendors/isotope/isotope-min.js') }}"></script>
    <script src="{{asset ('vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{asset ('js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{asset ('vendors/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{asset ('vendors/counter-up/jquery.counterup.js') }}"></script>
    <script src="{{asset ('js/mail-script.js') }}"></script>
    <script src="{{asset ('js/theme.js') }}"></script>
</body>

</html>
@yield('template')
