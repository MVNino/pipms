<div class="sidebar">
	<!-- User Widget -->
	<div class="widget user-dashboard-profile">
		<!-- User Image -->
		<div class="profile-thumb">
			<img src="{{ asset('classimax/images/user/user-thumb.jpg') }}" alt="" class="rounded-circle">
		</div>
		<!-- User Name -->
		<h5 class="text-center">Samanta Doe</h5>
		<p>Joined February 06, 2017</p>
		<a href="user-profile.html" class="btn btn-main-sm">Edit Profile</a>
	</div>
	<!-- Dashboard Links -->
	<div class="widget user-dashboard-menu">
		<ul>
			<li class="active"><a href="/"><i class="fa fa-dashboard"></i> My Dashboard</a></li>
			<li><a href="{{ route('my-messages') }}"><i class="fa fa-envelope"></i> Messages <span>5</span></a></li>
			<li><a href="{{ route('my-account') }}"><i class="fa fa-file-archive-o"></i>My Account <span>12</span></a></li>
			<li><a href="#"><i class="fa fa-bolt"></i> Apply Project<span>23</span></a></li>
			<li><a href="{{ route('my-projects') }}"><i class="fa fa-bolt"></i> My Projects<span>23</span></a></li>
			<li><a href=""><i class="fa fa-power-off"></i>Deactivate Account</a></li>
		</ul>
	</div>
</div>