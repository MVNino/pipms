@extends('admin.layouts.app')

@section('pg-specific-css')
  {{-- <link rel="stylesheet" type="text/css" href="{!! $chart->assets() !!}"> --}}
  {{-- {!! $chart->assets() !!} --}}
@endsection

@section('pg-title')
<h1><i class="fa fa-dashboard"></i> Dashboard 
  <small style="color: maroon;">
    (as of {{ Carbon\Carbon::now()->format('F d') }})
  </small>
</h1>
  <p>Informations at a glance</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
@endsection
@section('content')
<div class="row">
  <div class="col-sm-6 col-md-6 col-lg-3">
    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
      <div class="info">
        <h4>Authors</h4>
        <p><span class="count"><b>{{ $usersCount }}</b></span></p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-6 col-lg-3">
    <div class="widget-small info coloured-icon"><i class="icon fa fa-sign-in fa-3x"></i>
      <div class="info">
        <h4>Account Requests</h4>
        <p><span class="count"><b>4001</b></span></p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-6 col-lg-3">
    <div class="widget-small warning coloured-icon"><i class="icon fa fa-copyright fa-3x"></i>
      <div class="info">
        <h4>Copyrights</h4>
        <p><span class="count"><b>{{ $copyrightCount }}</b></span></p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-6 col-lg-3">
    <div class="widget-small danger coloured-icon"><i class="icon fa fa-folder fa-3x"></i>
      <div class="info">
        <h4>Patents</h4>
        <p><span class="count"><b>{{ $patentCount}}</b></span></p>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 col-lg-6">
    <div class="tile">
      <h3 class="tile-title">Copyright VS Patent Monthly Overview</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-lg-6">
    <div class="tile">
      <h3 class="tile-title">
        Copyright Vs. Patent Rating for {{ Carbon\Carbon::now()->format('F') }}
      </h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 col-lg-6">
    <div class="tile">
      <h3 class="tile-title">Monthly Copyrights</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-lg-6">
    <div class="tile">
      <h3 class="tile-title">Patentability Rate</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="doughnutChartDemo"></canvas>
      </div>
    </div>
  </div>
</div>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/widgets.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/chart.js') }}"></script>
<script type="text/javascript">
  
</script>
<script>
  $(document).ready(function(){
    $('a[href="/admin/dashboard"]').addClass('active');
  });
</script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script> --}}
{{-- {!! $chart->script() !!} --}}


<script>

</script>

<script>
( function($) {
  var charts = {
    init: function(){
      // this.ajaxGetPostMonthlyData();
      this.ajaxGetPostMonthlyData();
      // this.monthlyCopyrightChart(3);
    },

    ajaxGetPostMonthlyData: function() {
      var urlPath = 'http://' + window.location.hostname + '/monthly-copyrights-patents';
      var request = $.ajax({
        method: 'GET',
        url: urlPath,
      });
        request.done(function(response){
          console.log(response);
          charts.monthlyCopyrightPatentChart(response);
        });
    },

    monthlyCopyrightPatentChart: function(response){
      var lineData = {
        labels: response[0].months,
        datasets: [
          {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: response[0].copyright_count_data
          },
          {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: response[1].patent_count_data
          }
        ]
      };
      var barData = {
        labels: response[0].months,
        datasets: [
          {
            label: "Copyright Dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "maroon",
            pointStrokeColor: "maroon",
            pointHighlightFill: "#f3f3f3",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: response[0].copyright_count_data
          }
        ]
      };
      
      var pdata = [
        {
          value: 300,
          color: "#46BFBD",
          highlight: "#5AD3D1",
          label: "In In-Progress"
        },
        {
          value: 50,
          color:"#F7464A",
          highlight: "#FF5A5E",
          label: "Complete"
        }
      ]
      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(lineData);
      
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);

      var ctxb = $("#barChartDemo").get(0).getContext("2d");
      var barChart = new Chart(ctxb).Bar(barData);

      var ctxd = $("#doughnutChartDemo").get(0).getContext("2d");
      var doughnutChart = new Chart(ctxd).Doughnut(pdata);    
    },
  };

  charts.init();
})( jQuery );
  
</script>







@endsection