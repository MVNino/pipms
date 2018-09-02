<<<<<<< HEAD
<!-- Navbar-->
  <header class="app-header"><a class="app-header__logo" href="/">Pipms</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
      <li class="app-search">
        <input class="app-search__input" type="search" placeholder="Search">
        <button class="app-search__button"><i class="fa fa-search"></i></button>
      </li>
      <!--Notification Menu-->
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" style="text-decoration: none;" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i>
        @if(auth()->user()->unreadNotifications->count())
        <span class="badge badge-light">{{ auth()->user()->unReadNotifications->count() }}</span>
        @endif
      </a>
        <ul class="app-notification dropdown-menu dropdown-menu-right">
          @if (auth()->user()->notifications->count() > 0)
          <li class="app-notification__title"><a href="{{ route('readAllMark') }}">Mark all as read</a></li>
          @foreach(auth()->user()->unReadNotifications as $notification)
          <div class="app-notification__content">
            <li style="background-color: #f3f3f3;"><a class="app-notification__item" href="/admin/transaction/author/account-requests"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                <div>
                  <p class="app-notification__message">{!! $notification->data['data'] !!}</p>
                  <p class="app-notification__meta">Last: {{ $notification->created_at }}</p>
                </div></a></li>
          </div>
          @endforeach
          @foreach(auth()->user()->readNotifications as $notification)
          <div class="app-notification__content">
            <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                <div>
                  <p class="app-notification__message">{!! $notification->data['data'] !!}</p>
                  <p class="app-notification__meta">Last: {{ $notification->created_at }}</p>
                </div></a></li>
          </div>
          @endforeach
          <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
          @else
          <li class="app-notification__footer"><a href="#">There is no notification.</a></li>
          @endif
        </ul>
      </li>
      <!-- User Menu-->
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="#"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
          <li><a class="dropdown-item" href="#"><i class="fa fa-user fa-lg"></i> Profile</a></li>
          <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> {{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" 
              method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </li>
    </ul>
  </header>
=======

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg  navigation">
					<a class="navbar-brand" href="index.html">
						<img src="{{ asset('classimax/images/logo.png') }}" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						
						<ul class="navbar-nav ml-auto mt-10">
							<li class="nav-item">
								<a class="nav-link login-button btn-secondary" href="index.html">Logout</a>
							</li>
							
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
>>>>>>> 23af06319cd340b9b95e3e99d05758a833686ba4
