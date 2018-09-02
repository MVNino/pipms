<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="{{ asset('pk2/assets/img/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('pk2/assets/img/apple-icon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Paper Kit 2 by Creative Tim</title>

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

    <nav class="navbar navbar-expand-md fixed-top navbar-default">
        <div class="container">
                <button class="navbar-toggler navbar-toggler-right navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar"></span>
                    <span class="navbar-toggler-bar"></span>
                    <span class="navbar-toggler-bar"></span>
                </button>
                <a class="navbar-brand text-danger" href="https://www.creative-tim.com">PIPMS</a>
                 <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#pk">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pk">Link</a>
                        </li>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" href="#pk" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li class="dropdown-header">Dropdown header</li>
                                <a class="dropdown-item" href="#pk">Action</a>
                                <a class="dropdown-item" href="#pk">Another action</a>
                                <a class="dropdown-item" href="#pk">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#pk">Separated link</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#pk">Another separated link</a>
                            </ul>
                        </div>
                    </ul>
                </div> 
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">

                        <a href="documentation/tutorial-components.html" target="_blank" class="nav-link"><i class="nc-icon nc-book-bookmark"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="documentation/tutorial-components.html" target="_blank" class="nav-link"><i class="nc-icon nc-book-bookmark"></i> Request an account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav><br><br><br>
    <div class="wrapper">

  <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="first-slide" src="storage/images/carousel1.jpg" alt="First slide">
        <div class="container">
          <div class="carousel-caption text-right">
            <p><a class="btn btn-lg btn-primary" href="/copyright/create" role="button">Request for copyright now</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="second-slide" src="storage/images/carousel2.jpg" alt="Second slide">
        <div class="container">
          <div class="carousel-caption text-right">
            <p><a class="btn btn-lg btn-secondary" href="#" role="button">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="third-slide" src="storage/images/carousel3.jpg" alt="Third slide">
        <div class="container">
          <div class="carousel-caption text-left">
            <p><a class="btn btn-lg btn-primary" href="/register" role="button">Request faculty account</a></p>
          </div>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>  

        <div class="main">
            <div class="section text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <h2 class="title">Let's talk product</h2>
                        <h5 class="description">This is the paragraph where you can write more details about your product. Keep you user engaged by providing meaningful information. Remember that by this time, the user is curious, otherwise he wouldn't scroll to get here. Add a button if you want the user to see more.</h5>
                        <br>
                        <a href="#paper-kit" class="btn btn-danger btn-round">See Details</a>
                    </div>
                </div>
                <br/><br/>
                <div class="row">
                    <div class="col-md-3">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="nc-icon nc-album-2"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Beautiful Gallery</h4>
                                <p class="description">Spend your time generating new ideas. You don't have to think of implementing.</p>
                                <a href="#pkp" class="btn btn-link btn-danger">See more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="nc-icon nc-bulb-63"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">New Ideas</h4>
                                <p>Larger, yet dramatically thinner. More powerful, but remarkably power efficient.</p>
                                <a href="#pkp" class="btn btn-link btn-danger">See more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="nc-icon nc-chart-bar-32"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Statistics</h4>
                                <p>Choose from a veriety of many colors resembling sugar paper pastels.</p>
                                <a href="#pkp" class="btn btn-link btn-danger">See more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="nc-icon nc-sun-fog-29"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Delightful design</h4>
                                <p>Find unique and handmade delightful designs related items directly from our sellers.</p>
                                <a href="#pkp" class="btn btn-link btn-danger">See more</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="section section-dark text-center">
            <div class="container">
                <h2 class="title">Let's talk about us</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-profile card-plain">
                            <div class="card-avatar">
                                <a href="#avatar"><img src="{{ asset('pk2/assets/img/faces/clem-onojeghuo-3.jpg') }}" alt="..."></a>
                            </div>
                            <div class="card-body">
                                <a href="#paper-kit">
                                    <div class="author">
                                        <h4 class="card-title">Henry Ford</h4>
                                        <h6 class="card-category">Product Manager</h6>
                                    </div>
                                </a>
                                <p class="card-description text-center">
                                Teamwork is so important that it is virtually impossible for you to reach the heights of your capabilities or make the money that you want without becoming very good at it.
                                </p>
                            </div>
                            <div class="card-footer text-center">
                                <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-twitter"></i></a>
                                <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-google-plus"></i></a>
                                <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-profile card-plain">
                            <div class="card-avatar">
                                <a href="#avatar"><img src="{{ asset('pk2/assets/img/faces/joe-gardner-2.jpg') }}" alt="..."></a>
                            </div>
                            <div class="card-body">
                                <a href="#paper-kit">
                                    <div class="author">
                                        <h4 class="card-title">Sophie West</h4>
                                        <h6 class="card-category">Designer</h6>
                                    </div>
                                </a>
                                <p class="card-description text-center">
                                A group becomes a team when each member is sure enough of himself and his contribution to praise the skill of the others. No one can whistle a symphony. It takes an orchestra to play it.
                                </p>
                            </div>
                            <div class="card-footer text-center">
                                <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-twitter"></i></a>
                                <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-google-plus"></i></a>
                                <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-profile card-plain">
                            <div class="card-avatar">
                                <a href="#avatar"><img src="{{ asset('pk2/assets/img/faces/erik-lucatero-2.jpg') }}" alt="..."></a>
                            </div>
                            <div class="card-body">
                                <a href="#paper-kit">
                                    <div class="author">
                                        <h4 class="card-title">Robert Orben</h4>
                                        <h6 class="card-category">Developer</h6>
                                    </div>
                                </a>
                                <p class="card-description text-center">
                                The strength of the team is each individual member. The strength of each member is the team. If you can laugh together, you can work together, silence isn’t golden, it’s deadly.
                                </p>
                            </div>
                            <div class="card-footer text-center">
                                <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-twitter"></i></a>
                                <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-google-plus"></i></a>
                                <a href="#pablo" class="btn btn-link btn-just-icon btn-neutral"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="section landing-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <h2 class="text-center">Keep in touch?</h2>
                            <form class="contact-form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="nc-icon nc-single-02"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="nc-icon nc-email-85"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <label>Message</label>
                                <textarea class="form-control" rows="4" placeholder="Tell us your thoughts and feelings..."></textarea>
                                <div class="row">
                                    <div class="col-md-4 ml-auto mr-auto">
                                        <button class="btn btn-danger btn-lg btn-fill">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
    <footer class="footer footer-black">
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
