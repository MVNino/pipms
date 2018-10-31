@extends('admin.layouts.app')

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
    <div class="widget-small primary coloured-icon">
      <a href="/admin/reports/author" style="text-decoration: none;">
        <i class="icon fa fa-users fa-3x"></i>        
      </a>
      <div class="info">
        <h4>Authors</h4>
        <p><span class="count"><b>{{ $usersCount }}</b></span></p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-6 col-lg-3">
    <div class="widget-small info coloured-icon">
      <a href="/admin/transaction/author/account-requests" style="text-decoration: none;">
        <i class="icon fa fa-user-plus fa-3x"></i>
      </a>
      <div class="info">
        <h4>Account Requests</h4>
        <p><span class="count"><b>{{ $accountRequests }}</b></span></p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-6 col-lg-3">
    <div class="widget-small warning coloured-icon">
      <a href="/admin/reports/copyright" style="text-decoration: none;">
        <i class="icon fa fa-copyright fa-3x"></i>
      </a>
      <div class="info">
        <h4>Copyrighted</h4>
        <p><span class="count"><b>{{ $copyrighted }}</b></span></p>

      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-6 col-lg-3">
    <div class="widget-small danger coloured-icon">
      <a href="/admin/reports/patent" style="text-decoration: none;">
        <i class="icon fa fa-certificate fa-3x"></i>
      </a>
      <div class="info">
        <h4>Patented</h4>
        <p><span class="count"><b>{{$patented}}</b></span></p>

      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 col-lg-6">
    <div class="tile">
      <h3 class="tile-title">Copyright/Patent Monthly Overview</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-lg-6">
    <div class="tile">
      <h3 class="tile-title">
        Copyrights for {{ Carbon\Carbon::now()->format('F Y') }}
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
      <h3 class="tile-title">Monthly Copyrighted & Patented</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-lg-6">
    <div class="tile">
      <h3>Patents for {{ Carbon\Carbon::now()->format('F Y') }}</h3>
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
<script>
  $(document).ready(function(){
    $('a[href="/admin/dashboard"]').addClass('active');
  });
</script>
<script>
( function($) {
  var charts = {
    init: function(){
      this.ajaxGetPostMonthlyData();
      this.ajaxGetCopyrightsForThisMonth();
      this.ajaxGetMonthlyCopyrightedPatented();
      this.ajaxGetPatentsForThisMonth();
    },

    ajaxGetPostMonthlyData: function() {
      var urlPath = 'http://' + '127.0.0.1:8000' + '/monthly-copyrights-patents';
      // var erlPath = 'http://' + '127.0.0.1:8000' + '/monthly-copyrights-patents';
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
    
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(lineData);
    },

    ajaxGetCopyrightsForThisMonth: function() {
     var urlPath = 'http://' + '127.0.0.1:8000' + '/copyrights-for-this-month';
      var request = $.ajax({
        method: 'GET',
        url: urlPath,
      });
        request.done(function(response){
          console.log(response);
          charts.copyrightsForThisMonth(response);
        }); 
    },

    copyrightsForThisMonth: (response) => {
      var pdata = [
        {
          value: response[0].copyright_count_on_its_processes,
          color: "#46BFBD",
          highlight: "#5AD3D1",
          label: "Under its processes"
        },
        {
          value: response[0].copyright_count_copyrighted,
          color:"#F7464A",
          highlight: "#FF5A5E",
          label: "Copyrighted"
        }
      ]

      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);
    },

    ajaxGetMonthlyCopyrightedPatented: () => {
      var urlPath = 'http://' + '127.0.0.1:8000' + '/monthly-copyrights-patents';
      // var urlPath = 'http://' + '127.0.0.1:8000' + '/monthly-copyrights-patents';
      var request = $.ajax({
        method: 'GET',
        url: urlPath,
      });
        request.done((response) => {
          console.log(response);
          charts.getMonthlyCopyrightedPatented(response);
        });
    },

    getMonthlyCopyrightedPatented: (response) => {

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
          },
          {
            label: "Patent dataset",
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

      var ctxb = $("#barChartDemo").get(0).getContext("2d");
      var barChart = new Chart(ctxb).Bar(barData);   
    },
    
    ajaxGetPatentsForThisMonth: () => {
      var urlPath = 'http://' + '127.0.0.1:8000' + '/patents-for-this-month';
      var request = $.ajax({
        method: 'GET',
        url: urlPath,
      });
        request.done(function(response){
          console.log(response);
          charts.patentsForThisMonth(response);
        });
    },

    patentsForThisMonth: (response) => {
      var dData = [
        {
          value: response[0].patent_count_on_its_processes,
          color: "#46BFBD",
          highlight: "#5AD3D1",
          label: "Under its processes"
        },
        {
          value: response[0].patent_count_patented,
          color:"#F7464A",
          highlight: "#FF5A5E",
          label: "Patented"
        }
      ]
      var ctxd = $("#doughnutChartDemo").get(0).getContext("2d");
      var doughnutChart = new Chart(ctxd).Doughnut(dData); 
    },

  };

  charts.init();
})( jQuery );
</script>
@endsection