
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
				<div class="sidebar">
					<!-- User Widget -->
					<div class="widget user-dashboard-profile">
						<!-- User Image -->
						<div class="profile-thumb">
							<img src="{{asset ('classimax/images/user/user-thumb.jpg') }}" alt="" class="rounded-circle">
						</div>
						<!-- User Name -->
						<h5 class="text-center">Samanta Doe</h5>
						
						<a href="user-profile.html" class="btn btn-main-sm">Edit Profile</a>
					</div>
					<!-- Dashboard Links -->
					<div class="widget user-dashboard-menu">
						<ul>
							<li class="active" ><a href=""><i class="fa fa-user"></i> Dashboard</a></li>
							<li><a href=""><i class="fa fa-bookmark-o"></i> Messages </a></li>
							<li><a href=""><i class="fa fa-file-archive-o"></i>My Account </a></li>
							

							<!-- <li><a href=""><i class="fa fa-bolt"></i> Apply Project</a></li> -->
							<li><a href=""><i class="fa fa-cog"></i> My Projects</a></li>
							<li class="nav-item dropdown dropdown-slide">
								<a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-archive-o"></i> Apply Project <span><i class="fa fa-angle-down"></i></span>
								</a>
								<!-- Dropdown list -->
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#">Copyright</a>
									<a class="dropdown-item" href="#">Patent</a>
									
								</div>
							</li>
						</ul>
						

					</div>
					
				</div>
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
@include('author.includes.js-scripts')

</body>
</html>