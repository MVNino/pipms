<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('guest.includes.head-content')
    @yield('pg-specific-css')
</head>
<body id="body-guest">
  @include('guest.includes.navbar')
  <div class="container-fluid" style="padding:0;margin:0;">
    @include('guest.includes.messages')
    <main>
        @yield('content')
    </main>
  </div>
  <!-- Scripts -->
  <!-- Essential javascripts for application to work-->
  <script src="{{ asset('vali/js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('vali/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="{{ asset('vali/js/plugins/pace.min.js') }}"></script>
  @yield('pg-specific-js')
</body>
</html>
