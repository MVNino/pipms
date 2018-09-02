<!DOCTYPE html>
<html lang="en">
<head>
	@include('author.includes.head-content')
</head>

<body class="body-wrapper">
<section>
	@include('author.includes.navbar')
</section>
<!--==================================
=            User Profile            =
===================================-->
<section class="dashboard section">
	<!-- Container Start -->
	<div class="container">
		<!-- Row Start -->
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
				@include('author.includes.sidebar')
			</div>
			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<div class="widget dashboard-container my-adslist">
				@yield('content')
				</div>
			</div>
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</section>
<!--============================
=            Footer            =
=============================-->
@include('author.includes.footer')
  <!-- JAVASCRIPTS -->

    <script src="{{ asset('vali/js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('classimax/plugins/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('classimax/plugins/jquery-ui/dist/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('classimax/plugins/tether/js/tether.min.js') }}"></script>
  <script src="{{ asset('classimax/plugins/raty/jquery.raty-fa.js') }}"></script>
  <script src="{{ asset('classimax/plugins/bootstrap/dist/js/popper.min.js') }}"></script>
  <script src="{{ asset('classimax/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('classimax/plugins/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js') }}"></script>
  <script src="{{ asset('classimax/plugins/slick-carousel/slick/slick.min.js') }}"></script>
  <script src="{{ asset('classimax/plugins/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
  <script src="{{ asset('classimax/plugins/fancybox/jquery.fancybox.pack.js') }}"></script>
  <script src="{{ asset('classimax/plugins/smoothscroll/SmoothScroll.min.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
  <script src="{{ asset('classimax/js/scripts.js') }}"></script>
 @yield('pg-specific-js')

</body>
</html>