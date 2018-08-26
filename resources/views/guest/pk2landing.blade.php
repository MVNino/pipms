<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="{{ asset('pk2/assets/img/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('pk2/assets/img/apple-icon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>PUP-IPMS</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('pk2/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('pk2/assets/css/paper-kit.css?v=2.1.0') }}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('pk2/assets/css/demo.css') }}" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('pk2/assets/css/nucleo-icons.css') }}" rel="stylesheet" />

</head>

<body>
    <nav class="navbar navbar-expand-md fixed-top navbar-transparent" color-on-scroll="500">
        <div class="container">
            <div class="navbar-translate">
                <button class="navbar-toggler navbar-toggler-right navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar"></span>
                    <span class="navbar-toggler-bar"></span>
                    <span class="navbar-toggler-bar"></span>
                </button>
                <a class="navbar-brand" href="https://www.creative-tim.com">PIPMS</a>
                <a href="#" class="navbar-brand">Home</a>
            </div>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank">
                            <i class="fa fa-twitter"></i>
                            <p class="d-lg-none">Twitter</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/CreativeTim" target="_blank">
                            <i class="fa fa-facebook-square"></i>
                            <p class="d-lg-none">Facebook</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="https://www.instagram.com/CreativeTimOfficial" target="_blank">
                            <i class="fa fa-instagram"></i>
                            <p class="d-lg-none">Instagram</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Star on GitHub" data-placement="bottom" href="https://www.github.com/CreativeTimOfficial/paper-kit" target="_blank">
                            <i class="fa fa-github"></i>
                            <p class="d-lg-none">GitHub</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="documentation/tutorial-components.html" target="_blank" class="nav-link"><i class="nc-icon nc-book-bookmark"></i> Documentation</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/product/paper-kit-2-pro?ref=pk2-free-local" target="_blank" class="btn btn-danger btn-round">Upgrade to Pro</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        <div class="page-header section-dark" style="background-image: url('{{ asset('pk2/assets/img/antoine-barres.jpg') }}')">
            <div class="filter"></div>
            <div class="content-center">
                <div class="container">
                    <div class="title-brand">
                        <h1 class="presentation-title">PIPMS</h1>
                        <div class="fog-low">
                            <img src="{{ asset('pk2/assets/img/fog-low.png') }}" alt="">
                        </div>
                        <div class="fog-low right">
                            <img src="{{ asset('pk2/assets/img/fog-low.png') }}" alt="">
                        </div>
                    </div>

                    <h2 class="presentation-subtitle text-center">PUP - Intellectual Property Management System</h2>
                </div>
            </div>
            <div class="moving-clouds" style="background-image: url('{{ asset('pk2/assets/img/clouds.png') }}'); ">

            </div>
        </div>
            <br/>
            <div class="section" id="carousel">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <div class="card page-carousel">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <img class="d-block img-fluid" src="{{ asset('pk2\assets\img\soroush-karimi.jpg') }}" alt="First slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <p>Somewhere</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block img-fluid" src="{{ asset('pk2\assets\img\federico-beccari.jpg') }}" alt="Second slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <p>Somewhere else</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block img-fluid" src="{{ asset('pk2\assets\img\joshua-stannard.jpg') }}" alt="Third slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <p>Here it is</p>
                                        </div>
                                    </div>
                                    </div>

                                    <a class="left carousel-control carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="fa fa-angle-left"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="fa fa-angle-right"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section section-dark section-nucleo-icons">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <h2 class="title">Nucleo Icons</h2><br/>
                            <p class="description">
                                Now UI Kit comes with 100 custom icons made by our friends from NucleoApp. The official package contains over 2.100 thin icons which are looking great in combination with Now UI Kit Make sure you check all of them and use those that you like the most.
                            </p><br/>
                            <a href="nucleo-icons-demo.html" class="btn btn-danger btn-round" target="_blank">View Demo Icons</a>
                            <a href="https://nucleoapp.com/?ref=1712" class="btn btn-outline-danger btn-round" target="_blank">View All Icons</a>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="icons-container">
                                <i class="nc-icon nc-time-alarm"></i>
                                <i class="nc-icon nc-atom"></i>
                                <i class="nc-icon nc-camera-compact"></i>
                                <i class="nc-icon nc-watch-time"></i>
                                <i class="nc-icon nc-key-25"></i>
                                <i class="nc-icon nc-diamond"></i>
                                <i class="nc-icon nc-user-run"></i>
                                <i class="nc-icon nc-layout-11"></i>
                                <i class="nc-icon nc-badge"></i>
                                <i class="nc-icon nc-bulb-63"></i>
                                <i class="nc-icon nc-favourite-28"></i>
                                <i class="nc-icon nc-planet"></i>
                                <i class="nc-icon nc-tie-bow"></i>
                                <i class="nc-icon nc-zoom-split"></i>
                                <i class="nc-icon nc-cloud-download-93"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section section-dark">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto text-center">
                            <h2 class="title">Completed with examples</h2>
                            <p class="description">The kit comes with three pre-built pages to help you get started faster. You can change the text and images and you're good to go. More importantly, looking at them will give you a picture of what you can built with this powerful kit.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section section-image section-login" style="background-image: url('{{ asset('pk2/assets/img/login-image.jpg') }}');">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 ml-auto mr-auto">
                            <div class="card card-register">
                                <h3 class="title">Welcome</h3>
                                <div class="social-line text-center">
                                    <a href="#pablo" class="btn btn-neutral btn-facebook btn-just-icon">
                                        <i class="fa fa-facebook-square"></i>
                                    </a>
                                    <a href="#pablo" class="btn btn-neutral btn-google btn-just-icon">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                    <a href="#pablo" class="btn btn-neutral btn-twitter btn-just-icon">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </div>
                                <form class="register-form">
                                    <label>Email</label>
                                    <div class="input-group form-group-no-border">
                                        <span class="input-group-addon">
                                            <i class="nc-icon nc-email-85"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Email">
                                    </div>

                                    <label>Password</label>
                                    <div class="input-group form-group-no-border">
                                        <span class="input-group-addon">
                                            <i class="nc-icon nc-key-25"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Password">
                                    </div>
                                    <button class="btn btn-danger btn-block btn-round">Register</button>
                                </form>
                                <div class="forgot">
                                    <a href="#" class="btn btn-link btn-danger">Forgot password?</a>
                                </div>
                            </div>
                            <div class="col text-center">
                                <a href="examples/register.html" class="btn btn-outline-neutral btn-round btn-lg" target="_blank">View Register Page</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section section-dark">
                <div class="container">
                    <div class="row example-page">
                        <div class="col-md-6 text-center">
                            <a href="examples/landing.html" target="_blank">
                                <img src="{{ asset('pk2/assets\img\examples\landing-page.jpg') }}" alt="Rounded Image" class="img-rounded img-responsive" style="width: 100%">
                                <a href="examples/landing.html" class="btn btn-outline-neutral btn-round" target="_blank">Landing Page</a>
                            </a>
                        </div>
                        <div class="col-md-6 text-center">
                            <a href="examples/profile.html" target="_blank">
                                <img src="{{ asset('pk2/assets\img\examples\profile-page.jpg') }}" alt="Rounded Image" class="img-rounded img-responsive" style="width: 100%">
                                <a href="examples/profile.html" class="btn btn-outline-neutral btn-round" target="_blank">Profile Page</a>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="container text-center">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto text-center">
                            <h2 class="title">Do you like what you see?</h2>
                            <p class="description">Cause if you do, it can be yours for Free. Hit the button below and download it. Start a new project or give an old Bootstrap 4 project a new look.</p>
                        </div>
                        <div class="col-md-5 ml-auto mr-auto download-area">
                            <a href="http://www.creative-tim.com/product/paper-kit-2" class="btn btn-danger btn-round">Download free HTML</a>
                        </div>
                    </div>
                    <div class="row text-center upgrade-pro">
                        <div class="col-md-8 ml-auto mr-auto">
                            <h2 class="title">Want more?</h2>
                            <p class="description">We've just launched <a href="http://demos.creative-tim.com/paper-kit-2-pro/presentation.html?ref=utp-pk2-demos" class="text-danger" target="_blank">Paper Kit 2 PRO</a>. It has a huge number of components, sections and example pages.</p>
                        </div>
                        <div class="col-sm-5 ml-auto mr-auto">
                            <a href="https://www.creative-tim.com/product/paper-kit-2-pro?ref=utp-pk-demos" class="btn btn-info btn-round" target="_blank">
                                <i class="nc-icon nc-spaceship" aria-hidden="true"></i> Upgrade to PRO
                            </a>
                        </div>
                    </div>
                    <div class="row justify-content-md-center sharing-area text-center">
                        <div class="text-center col-md-12 col-lg-8">
                            <h3>Thank you for supporting us!</h3>
                        </div>
                        <div class="text-center col-md-12 col-lg-8">
                            <a href="#pablo" class="btn btn-twitter-bg twitter-sharrre btn-round" rel="tooltip" title="Tweet!">
                                <i class="fa fa-twitter"></i> Twitter
                            </a>
                            <a href="#pablo" class="btn btn-google-bg linkedin-sharrre btn-round" rel="tooltip" title="Share!">
                                <i class="fa fa-google-plus"></i> Google
                            </a>
                            <a href="#pablo" class="btn btn-facebook-bg facebook-sharrre btn-round" rel="tooltip" title="Share!">
                                <i class="fa fa-facebook-square"></i> Facebook
                            </a>
                            <a href="https://github.com/creativetimofficial/paper-kit" class="btn btn-github-bg btn-github sharrre btn-round" rel="tooltip" title="Star on Github">
                                <i class="fa fa-github"></i> Star
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <nav class="footer-nav">
                    <ul>
                        <li><a href="http://www.creative-tim.com">Creative Tim</a></li>
                        <li><a href="http://blog.creative-tim.com">Blog</a></li>
                        <li><a href="http://www.creative-tim.com/license">Licenses</a></li>
                    </ul>
                </nav>
                <div class="credits ml-auto">
                    <span class="copyright">
                        © <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
                    </span>
                </div>
            </div>
        </div>
    </footer>
</body>

<!-- Core JS Files -->
<script src="{{ asset('pk2/assets/js/jquery-3.2.1.js') }}" type="text/javascript"></script>
<script src="{{ asset('pk2/assets/js/jquery-ui-1.12.1.custom.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pk2/assets/js/popper.js') }}" type="text/javascript"></script>
<script src="{{ asset('pk2/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!-- Switches -->
<script src="{{ asset('pk2/assets/js/bootstrap-switch.min.js') }}"></script>

<!--  Plugins for Slider -->
<script src="{{ asset('pk2/assets/js/nouislider.js') }}"></script>

<!--  Plugins for DateTimePicker -->
<script src="{{ asset('pk2/assets/js/moment.min.js') }}"></script>
<script src="{{ asset('pk2/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

<!--  Paper Kit Initialization and functons -->
<script src="{{ asset('pk2/assets/js/paper-kit.js?v=2.1.0') }}"></script>

</html>
