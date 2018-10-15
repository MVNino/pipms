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

                 {{-- IPR Menu --}}
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown-ipr" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Intellectual Property Rights</a>
                  <div class="dropdown-menu" aria-labelledby="dropdown10">
                    <a class="dropdown-item" href="{{ route('application.guide') }}">IPR Application</a>
                    <a class="dropdown-item" href="{{ route('copyrightables') }}">Copyrightable Works</a>
                    <a class="dropdown-item" href="{{ route('patentables') }}">Patentable Works</a>
                  </div>
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
                  <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown-login" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</a>
                  <div class="dropdown-menu" aria-labelledby="dropdown10">
                    <a class="dropdown-item" href="{{ route('login.author') }}">as Author</a>
                    <a class="dropdown-item" href="{{ route('login.admin') }}">as Admin</a>
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