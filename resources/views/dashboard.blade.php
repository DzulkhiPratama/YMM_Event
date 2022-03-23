<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <link rel="icon" type="image/png" href="/assets/img/imgymm.png">
    <title>YMM PTFI Dashboard</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/carousel/">

    <!-- Bootstrap core CSS -->
    <link href="/assets/distA/css/bootstrap.min.css" rel="stylesheet">
    <link href="/carousel.css" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <nav class="navbar navbar-light bg-light">
                    <a class="navbar-brand" href="#">
                        <img src="/assets/img/imgymm.png" width="120" height="50" class="d-inline-block align-top" alt="">
                    </a>
                </nav>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">Unit Kegiatan</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown03">
                                @foreach($list_unit as $unit)
                                <li><a class="dropdown-item" href="/event/<?= $unit['unit_code_str']; ?>"><?= $unit['unit_name']; ?></a></li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">DKM</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown03">
                                @foreach($list_dkm as $dkm)
                                <li><a class="dropdown-item" href="/event/<?= $dkm->unit_code_str; ?>"><?= $dkm->unit_name; ?></a></li>
                                @endforeach
                            </ul>
                        </li>

                        @auth
                        @if(auth()->user()->role_id==2)
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/user">User management</a>
                        </li>
                        @endif
                        @endauth

                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">{{ auth()->user()->name }}</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown03">
                                <li class="nav-item dropdown">
                                    <FORM method="POST" action="/logout">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i>Log Out</i></button>
                                    </FORM>
                                </li>
                            </ul>
                        </li>


                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Log in</a>
                        </li>
                        @endauth
                    </ul>

                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="row"></div>
        <div class="row mt-2"></div>
        <div class="col-lg-10 col-md-8 mx-auto">
            <div class="row m-lg-2">
                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" class="m-lg-3">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/assets/img/ymmB.jpg">
                            <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <rect width="100%" height="100%" fill="#777" />
                            </svg>

                            <div class="container">
                                <div class="carousel-caption text-start">
                                    <h1>Join YMM !</h1>
                                    <p>Some representative placeholder content for the first slide of the carousel.</p>
                                    <p><a class="btn btn-lg btn-primary border-0" style="background-color: #2e8b57;" href="#">Sign up today</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="/assets/img/ymmA.jpg">
                            <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <rect width="100%" height="100%" fill="#777" />
                            </svg>

                            <div class="container">
                                <div class="carousel-caption">
                                    <h1>Another example headline.</h1>
                                    <p>Some representative placeholder content for the second slide of the carousel.</p>
                                    <p><a class="btn btn-lg btn-primary border-0" style="background-color: #2e8b57;" href="#">Learn more</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="/assets/img/ymmA.jpg">
                            <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <rect width="100%" height="100%" fill="#777" />
                            </svg>

                            <div class="container">
                                <div class="carousel-caption">
                                    <h1>Another example headline.</h1>
                                    <p>Some representative placeholder content for the second slide of the carousel.</p>
                                    <p><a class="btn btn-lg btn-primary border-0" style="background-color: #2e8b57;" href="#">Learn more</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <section class="py-2 text-center container">
            <div class="row py-lg-1">
                <div class="col-lg-6 col-md-4 mx-auto">
                    <h1 class="fw-light">Tetang YMM Activity Report</h1>
                    <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>

                </div>
            </div>
        </section>

        <div class="container marketing">
            <hr class="featurette-divider">
            <section class="py-2 text-center container">
                <div class="row py-lg-3">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <h1 class="fw-light">Unit Kegiatan YMM</h1>
                    </div>
                </div>
            </section>

            <div class="row">
                @foreach($list_unit as $ty => $value)

                <div class="col-md-4">
                    <div class="profile-card-4 text-center"><img src="/assets/img/unit.jpg" class="img img-responsive">
                        <div class="profile-content">
                            <div class="profile-name"><?= $value['unit_name']; ?>
                            </div>
                            <div class="profile-description"><?= $value['unit_desc']; ?></div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="profile-overview">
                                        <p>EVENTS</p>
                                        <h4><?= $unit_event_count[$ty]; ?></h4>
                                    </div>
                                </div>
                                <p><a class="btn btn-secondary" href="/event/<?= $value['unit_code_str']; ?>">View Activities &raquo;</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <hr class="featurette-divider">
                <section class="py-2 text-center container">
                    <div class="row py-lg-3">
                        <div class="col-lg-6 col-md-8 mx-auto">
                            <h1 class="fw-light">Dewan Kemakmuran Masjid YMM</h1>
                        </div>
                    </div>
                </section>

                @foreach($list_dkm as $ty => $value)

                <div class="col-md-4">
                    <div class="profile-card-4 text-center"><img src="/assets/img/dkm.jpg" class="img img-responsive">
                        <div class="profile-content">
                            <div class="profile-names"><?= $value->unit_name; ?>
                            </div>
                            <div class="profile-description"><?= $value->unit_desc; ?></div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="profile-overview">
                                        <p>EVENTS</p>
                                        <h4><?= $dkm_event_count[$ty]; ?></h4>
                                    </div>
                                </div>
                                <p><a class="btn btn-secondary" href="/event/<?= $value->unit_code_str; ?>">View Activities &raquo;</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div><!-- /.row -->


            <!-- START THE FEATURETTES -->

            <hr class="featurette-divider">

            <!-- /END THE FEATURETTES -->

        </div><!-- /.container -->


        <!-- FOOTER -->
        <footer class="container">
            <p class="float-end"><a href="#">Back to top</a></p>
            <p>&copy; 2022, YMM PTFI. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </footer>
    </main>

    <script src="/assets/distA/js/bootstrap.bundle.min.js"></script>


</body>

</html>