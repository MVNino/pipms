      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">PUP - Intellectual Property Management System</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            {{-- <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form> --}}
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link btn-magnify" href="{{ route('author.my-projects') }}">
                  <i class="nc-icon nc-layout-11"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              {{-- Notification --}}
              {{-- <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-bell-55"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                  @if(auth()->user()->unreadNotifications->count())
                  <span class="badge badge-danger">{{ auth()->user()->unReadNotifications->count() }}</span>
                  @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  @if (auth()->user()->notifications->count() > 0)
                  <a class="dropdown-item" href="{{ route('readAllMark') }}">Mark all as read</a>
                  @foreach(auth()->user()->unReadNotifications as $notification)
                    <a class="dropdown-item" href="#">
                      <small>
                        {!! $notification->data['data'] !!}
                        <br>
                        Last: {{ $notification->created_at }}
                      </small>
                    </a>
                  @endforeach
                  @foreach(auth()->user()->readNotifications as $notification)
                    <a class="dropdown-item">{!! $notification->data['data'] !!}</a>
                    <a class="dropdown-item">Last: {{ $notification->created_at }}</a>
                  @endforeach 
                  @else
                  <a class="dropdown-item" href="#">There is no notification.</a>
                  @endif
                </div>
              </li> --}}

              <!--Notification Menu-->
              <li class="nav-item button-rotate dropdown" style="margin-top: .75em;">
                <a class="app-nav__item" href="#" data-toggle="dropdown" style="text-decoration: none;" aria-label="Show notifications">
                  <i class="fa fa-bell-o fa-lg"></i>
                @if(auth()->user()->unreadNotifications->count())
                <span class="badge badge-light">{{ auth()->user()->unReadNotifications->count() }}</span>
                @endif
                </a>
                <ul class="app-notification dropdown-menu dropdown-menu-right">
                  @if (auth()->user()->notifications->count() > 0)
                  <li class="app-notification__title"><a href="{{ route('author.readAllMark') }}">Mark all as read</a></li>
                  @foreach(auth()->user()->unReadNotifications as $notification)
                  <div class="app-notification__content">
                    <li>
                      <small>
                      <a class="app-notification__item" href="/author/notification/{{ $notification->id }}/read">
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
                              Yesterday, {{ $notification->created_at->format('h:i:A')}}
                            @elseif($notification->created_at->diffInDays(Carbon\Carbon::now()) == 2)
                              2 days ago at {{ $notification->created_at->format('h:i:A')}}
                            @else
                              {{ $notification->created_at->format('M d')}}
                            @endif
                          </p>
                        </div>
                      </a>
                      </small>
                    </li>
                  </div>
                  @endforeach
                  <li class="app-notification__footer">
                    <a href="{{ route('author.notifications') }}">
                      See all notifications.
                    </a>
                  </li>
                  @else
                  <li class="app-notification__footer">
                    <a href="#">
                      There is no notification.
                    </a>
                  </li>
                  @endif
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="{{ route('author.profile') }}">
                  <i class="nc-icon nc-settings-gear-65"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>&nbsp&nbsp&nbsp&nbsp&nbsp
      </nav>
      <!-- End Navbar -->