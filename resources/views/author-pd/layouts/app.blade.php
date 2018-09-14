<!DOCTYPE html>
<html lang="en">
<head>
  @include('author-pd.includes.head-content')
</head>

<body class="">
  <div class="wrapper"> 
  @include('author-pd.includes.sidebar')
    <div class="main-panel">
      @include('author-pd.includes.navbar')
  <!-- <div class="panel-header panel-header-lg">
  <canvas id="bigDashboardChart"></canvas>
</div> -->
      <div class="content">
        @include('author-pd.includes.messages')
        @yield('content')
      </div>
      @include('author-pd.includes.footer')
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('pd/assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('pd/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('pd/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('pd/assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="{{ asset('pd/assets/js/plugins/chartjs.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('pd/assets/js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('pd/assets/js/paper-dashboard.min.js?v=2.0.0') }}" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('pd/assets/demo/demo.js') }}"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
  @yield('pg-specific-js')
</body>
</html>