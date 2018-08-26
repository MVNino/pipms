@include('guest.includes.head-content')
<style>
  body {
    padding-top: 3rem;
  } 
</style>
</head>
<body id="body-guest">
  @include('guest.includes.navbar')
  <div class="container-fluid" style="padding:0;margin:0;">
    @include('guest.includes.messages')
    <main role="main">
      @yield('content')
    </main>
    @include('guest.includes.footer-guest')
  </div>
  @include('guest.includes.ckeditor')
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>

</body>
</html>
