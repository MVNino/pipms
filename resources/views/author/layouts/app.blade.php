<!DOCTYPE html>
<html lang="en">
  <head>
    @include('author.includes.head-content')
  <style>
    body {
      padding-bottom: 0;
    }
  </style>
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    @include('author.includes.navbar')
    <!-- Sidebar menu-->
    @include('author.includes.sidebar')
  <main class="app-content">
      <div class="app-title mb-3">
        <div>
          @yield('pg-title')
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="/">
            <i class="fa fa-home fa-lg"></i></a></li>
          @yield('breadcrumb-label')
        </ul>
      </div>
        @include('author.includes.messages')
        @yield('content')   
    </main>  
    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('vali/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('vali/js/popper.min.js') }}"></script>
    <script src="{{ asset('vali/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vali/js/main.js') }}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('vali/js/plugins/pace.min.js') }}"></script>
    @yield('pg-specific-js')
    @stack('article-ckeditor-script')
  </body>
</html>