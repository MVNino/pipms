{{-- @include('guest.includes.login-portal-modal') --}}
<nav class="navbar navbar-expand-md navbar-light navbar-laravel" id="navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}" style="font-weight: bold;color: maroon; ">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @guest
                <li class="nav-item">
                    <a class="nav-link {{Request::is('/') ? 'active':''}}" href="{{ route('index') }}">Home</a>
                </li>
                @endguest
                <li class="nav-item">
                    <a class="nav-link {{Request::is('application/guide') ? 'active':''}}" href="{{ route('application.guide') }}">IPR Application</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::is('about-us') ? 'active':''}}" href="{{ route('about-us') }}">About Us</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @guest
                 {{-- Login Menu --}}
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</a>
                  <div class="dropdown-menu" aria-labelledby="dropdown10">
                    <a class="dropdown-item" href="/author-login">as Author</a>
                    <a class="dropdown-item" href="/admin-login">as Admin</a>
                  </div>
                </li>

                @endguest
                <li class="nav-item">
                    <a class="nav-link {{Request::is('registration/author') ? 'active':''}}" href="/registration/author">Account Request</a>
                </li>
            </ul>
        </div>
    </div>
</nav>