@extends('author.layouts.app')


@section('pg-title')
<h1><i class="fa fa-dashboard"></i> Dashboard Author</h1>
  <p>Informations at a glance</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-6 col-lg-3">
    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
      <div class="info">
        <h4>Users</h4>
        <p><span class="count"><b>6</b></span></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="widget-small info coloured-icon"><i class="icon fa fa-sign-in fa-3x"></i>
      <div class="info">
        <h4>Visits</h4>
        <p><span class="count"><b>4001</b></span></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="widget-small warning coloured-icon"><i class="icon fa fa-copyright fa-3x"></i>
      <div class="info">
        <h4>Copyrights</h4>
        <p><span class="count"><b>267</b></span></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="widget-small danger coloured-icon"><i class="icon fa fa-certificate fa-3x"></i>
      <div class="info">
        <h4>Patents</h4>
        <p><span class="count"><b>125</b></span></p>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="tile">
      <h3 class="tile-title">Monthly Project Applications</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="tile">
      <h3 class="tile-title">Development Progress</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <div class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
      <div class="info">
        <h4>Users</h4>
        <p><b>5</b></p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="widget-small info"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
      <div class="info">
        <h4>Likes</h4>
        <p><b>25</b></p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="widget-small warning"><i class="icon fa fa-files-o fa-3x"></i>
      <div class="info">
        <h4>Uploades</h4>
        <p><b>10</b></p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="widget-small danger"><i class="icon fa fa-star fa-3x"></i>
      <div class="info">
        <h4>Stars</h4>
        <p><b>500</b></p>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="tile">
      <h3 class="tile-title">Bar Chart</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="tile">
      <h3 class="tile-title">Doughnut Chart</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="doughnutChartDemo"></canvas>
      </div>
    </div>
  </div>
</div>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/chart.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/widgets.js') }}"></script>
<script type="text/javascript">
  var data = {
    labels: ["January", "February", "March", "April", "May"],
    datasets: [
      {
        label: "My First dataset",
        fillColor: "rgba(220,220,220,0.2)",
        strokeColor: "rgba(220,220,220,1)",
        pointColor: "rgba(220,220,220,1)",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [65, 59, 80, 81, 56]
      },
      {
        label: "My Second dataset",
        fillColor: "rgba(151,187,205,0.2)",
        strokeColor: "rgba(151,187,205,1)",
        pointColor: "rgba(151,187,205,1)",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(151,187,205,1)",
        data: [28, 48, 40, 19, 86]
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
  var lineChart = new Chart(ctxl).Line(data);
  
  var ctxp = $("#pieChartDemo").get(0).getContext("2d");
  var pieChart = new Chart(ctxp).Pie(pdata);

  var ctxb = $("#barChartDemo").get(0).getContext("2d");
  var barChart = new Chart(ctxb).Bar(data);

  var ctxd = $("#doughnutChartDemo").get(0).getContext("2d");
  var doughnutChart = new Chart(ctxd).Doughnut(pdata);
</script>
<script>
  $(document).ready(function(){
    $('a[href="/admin/dashboard"]').addClass('active');
  });
</script>
@endsection