<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('guest.includes.head-content')
    <!-- Page Specific CSS -->
    @yield('pg-specific-css')
</head>
<body id="body-guest">
  @include('guest.includes.navbar')
  <div class="container-fluid" style="padding:0;margin:0;">
    @include('guest.includes.messages')
    <main class="py-4">
        @yield('content')
    </main>
  </div>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('vali/js/plugins/pace.min.js') }}"></script>
  <!-- Page Specific Javascripts -->
  @yield('pg-specific-js')
  
</body>
</html>
