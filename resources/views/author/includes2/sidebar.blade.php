<<<<<<< HEAD
<!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="/storage/images/profile/{{ auth()->user()->str_user_image_code }}" alt="User Image" style="height: 48px; width: 48px;">
      <div>
        <p class="app-sidebar__user-name">{{ Auth::user()->str_first_name }} {{ Auth::user()->str_last_name }}</p>
        <p class="app-sidebar__user-designation">Author</p>
      </div>
    </div>
    <ul class="app-menu">
      <li><a class="app-menu__item {{Request::is('author/{id}/dashboard') ? 'active':''}}" href="/author/{{ auth()->user()->id }}/dashboard"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
      <li><a class="app-menu__item {{Request::is('author/messages') ? 'active':''}}" href="/author/messages"><i class="app-menu__icon fa fa-envelope"></i><span class="app-menu__label">Messages</span></a></li>
      <li><a class="app-menu__item {{Request::is('author/my-account') ? 'active':''}}" href="/author/my-account"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">My Account</span></a></li>
      <li class="treeview" id="li-apply"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Apply project</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="/author/apply-project">Copyright</a></li>
          <li><a class="treeview-item" href="/author/apply-patent-project">Patent</a></li>
        </ul>
      </li>
      <li><a class="app-menu__item {{Request::is('author/my-projects') ? 'active':''}}" href="/author/my-projects"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">My Projects</span></a></li>
    </ul>
  </aside>
=======
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
>>>>>>> 23af06319cd340b9b95e3e99d05758a833686ba4
