<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ $title }}</title>
    <link rel="icon" href="{{ asset('storage/img/logo.png') }}" type="image">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
        rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <link href="user/css/homepage.css" rel="stylesheet">
</head>

<body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-10 px-lg-10">
            <a class="navbar-brand logo_h" href="/">
                <img src="{{ asset('storage/img/logo.jpg') }}" width="110px">
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            {{-- <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Product</a></li>
                    </ul>
                </div> --}}
        </div>
    </nav>
    <div id="about">
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-black font-weight-bold">HOODIE STATION</h1>
                        <h1 class="text-white font-weight-bold">Discount Up To 40%</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">Long-sleeved hoodie in soft sweatshirt fabric with a kangaroo
                            pocket, double-layered drawstring hood with a wrapover front, and ribbing at the cuffs and
                            hem
                        </p>
                        @if (Auth::guard('user')->user())
                            <a class="btn btn-danger" href="/shop">Lihat Hoodie Lainnya</a>
                        @else
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a href="{{ Route('login') }}" class="btn btn-danger rounded-pill">Get Started</a>
                                </li>
                            </ul>
                        @endauth
                </div>
            </div>
        </div>
    </header>
    {{-- <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">We've got what you need!</h2>
                        <p class="text-white-75 mb-4">Start Bootstrap has everything you need to get your new website up and running in no time! Choose one of our open source, free to download, and easy to use themes! No strings attached!</p>
                        <a class="btn btn-light btn-xl" href="#services">Get Started!</a>
                    </div>
                </div>
            </div>
        </section> --}}
    <div id="portfolio">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box">
                        <img class="img-fluid" src="{{ asset('storage/img/1.jpg') }}" width="500px" />
                        <div class="portfolio-box-caption">
                            <div class="project-name">Hoodie Hooligans</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box">
                        <img class="img-fluid" src="{{ asset('storage/img/2.jpg') }}" width="500px" />
                        <div class="portfolio-box-caption">
                            <div class="project-name">Hoodie Dobujack</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box">
                        <img class="img-fluid" src="{{ asset('storage/img/3.jpg') }}" width="500px" />
                        <div class="portfolio-box-caption">
                            <div class="project-name">Hoodie Roughneck</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box">
                        <img class="img-fluid" src="{{ asset('storage/img/4.jpg') }}" width="500px" />
                        <div class="portfolio-box-caption">
                            <div class="project-name">Hoodie Bloods</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box">
                        <img class="img-fluid" src="{{ asset('storage/img/5.jpg') }}" width="500px" />
                        <div class="portfolio-box-caption">
                            <div class="project-name">Hoodie H&M</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box">
                        <img class="img-fluid" src="{{ asset('storage/img/6.jpg') }}" width="500px" />
                        <div class="portfolio-box-caption">
                            <div class="project-name">Hoodie Pull & Bear</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
