<div class="sidebar">
	<!-- User Widget -->
	<div class="widget user-dashboard-profile">
		<!-- User Image -->
		<div class="profile-thumb">
			<img src="{{asset ('classimax/images/user/user-thumb.jpg') }}" alt="" class="rounded-circle">
		</div>
		<!-- User Name -->
		<h5 class="text-center">Samanta Doe</h5>
		
		<a href="/author/edit-profile" class="btn btn-main-sm">Edit Profile</a>
	</div>
	<!-- Dashboard Links -->
	<div class="widget user-dashboard-menu">
		<ul>
			<li><a href="/" class="active"><i class="fa fa-user"></i> Dashboard</a></li>
			<li id="li-my-messages" class="{{Request::is('author/my-messages') ? 'active':''}}"><a href="/author/my-messages"><i class="fa fa-bookmark-o"></i> Messages </a></li>
			<li id="li-my-account" class="{{Request::is('author/my-account') ? 'active':''}}"><a href="/author/my-account"><i class="fa fa-file-archive-o"></i>My Account </a></li>
			

			<!-- <li><a href=""><i class="fa fa-bolt"></i> Apply Project</a></li> -->
			<li id="li-my-projects" class="{{Request::is('author/my-projects') ? 'active':''}}"><a href="/author/my-projects"><i class="fa fa-cog"></i> My Projects</a></li>
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