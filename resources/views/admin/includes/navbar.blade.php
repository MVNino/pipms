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
      <li class="dropdown">
        <a class="app-nav__item" href="#" data-toggle="dropdown" style="text-decoration: none;" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i>
        @if(auth()->user()->unreadNotifications->count())
        <span class="badge badge-light">{{ auth()->user()->unReadNotifications->count() }}</span>
        @endif
        </a>
        <ul class="app-notification dropdown-menu dropdown-menu-right">
          @if (auth()->user()->notifications->count() > 0)
          <li class="app-notification__title"><a href="{{ route('readAllMark') }}">Mark all as read</a></li>
          @foreach(auth()->user()->unReadNotifications as $notification)
          <div class="app-notification__content">
            <li style="background-color: #f3f3f3;">
              <a class="app-notification__item" href="/admin/transaction/author/account-requests">
                <span class="app-notification__icon">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                    <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                  </span>
                </span>
                <div>
                  <p class="app-notification__message">{!! $notification->data['data'] !!}</p>
                  <p class="app-notification__meta">
                    @if($notification->created_at->diffInDays(Carbon\Carbon::now()) == 0)
                      @if($notification->created_at->diffInHours(Carbon\Carbon::now()) > 0)
                        @if($notification->created_at->diffInHours(Carbon\Carbon::now()) == 1)
                        An hour ago.
                        @else
                        {{ $notification->created_at->diffInHours(Carbon\Carbon::now()) }} hours ago.
                        @endif
                      @else
                        @if($notification->created_at->diffInMinutes(Carbon\Carbon::now()) <= 1)
                        A minute ago.
                        @else
                        {{ $notification->created_at->diffInMinutes(Carbon\Carbon::now()) }} minutes ago.
                        @endif
                      @endif                    
                    @elseif($notification->created_at->diffInDays(Carbon\Carbon::now()) == 1)
                      Yesterday at {{ $notification->created_at->format('h:i:A')}}
                    @elseif($notification->created_at->diffInDays(Carbon\Carbon::now()) == 2)
                      2 days ago at {{ $notification->created_at->format('h:i:A')}}
                    @else
                      {{ $notification->created_at->format('M d')}}
                    @endif
                  </p>
                </div>
              </a>
            </li>
          </div>
          @endforeach
          <li class="app-notification__footer"><a href="{{ route('admin.notifications') }}">See all notifications.</a></li>
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