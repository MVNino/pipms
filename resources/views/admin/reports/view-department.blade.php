@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> {{ $department->char_department_code }} Reports</h1>
  <p>Copyright and Patent Statistics as of today, 
    <span class="text-primary">{{ Carbon\Carbon::now()->format('F d') }}</span> 
  </p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Reports</li>
<li class="breadcrumb-item"><a href="{{ route('reports.departments') }}">Departments</a></li>
<li class="breadcrumb-item">
  <a href="/admin/reports/department/{{ $department->int_id }}">
    {{ $department->char_department_code }}
  </a>
</li>
@endsection

@section('content')
<div class="row">
  <div class="col-md-5">
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
        <div class="row">
          <div class="col-md-10">
            <h4>
              <a href="/admin/maintenance/department/{{ $department->int_id }}">
                {{ $department->char_department_code }}
              </a>
            </h4>
          </div>
          <div class="col-md-2">
            {{-- <p><button type="button" class="btn btn-primary mb-1 float-right" data-toggle="modal" data-target="#modalLong"><i class="fa fa-edit"></i>Edit</button></p> --}}
          </div>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">{{ $department->str_department_name }}</h5>
          <h6 class="card-subtitle text-muted">
            <a href="/admin/maintenance/college/{{ $department->int_college_id }}">
              {{ $department->college->char_college_code }}
            </a> - 
            <a href="/admin/maintenance/branch/{{ $department->college->branch->int_id }}">
              {{ $department->college->branch->str_branch_name }}
            </a>
          </h6>
        </div>
        <div style="position: relative;">
        <a target="_blank" href="/storage/images/department/banner/{{ $department->str_department_banner_image }}">
        <img style="height: 200px; width: 100%; display: block;" src="/storage/images/department/banner/{{ $department->str_department_banner_image }}" alt="Department banner image">
        </a>
          <a target="_blank" href="/storage/images/department/profile/{{ $department->str_department_profile_image }}" style="position: absolute; bottom: -5%; left: 38%;">
              <img class="align-self-center rounded-circle mr-3" style="width:125px; height:125px;" alt="Department profile image" src="/storage/images/department/profile/{{ $department->str_department_profile_image }}">
          </a>
        </div>
        <div class="card-footer text-muted"><strong>Date added:</strong> 
            @if($department->created_at->diffInDays(Carbon\Carbon::now()) < 2)
              {{ $department->created_at->format('M d - g:i A') }}
            @else
              {{ $department->created_at->format('F d, Y') }}
            @endif
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="tile">
      <h3 class="tile-title">{{ $department->char_department_code }} Monthly <small>Copyright / Patent Statistics</small></h3>
      <div class="tile-body">
        <div class="embed-responsive embed-responsive-16by9">
          <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
        </div>
      </div>
      {{-- <div class="tile-footer">
      </div> --}}
    </div>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
        <ul class="nav nav-tabs">
          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#copyright">Copyright</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#patent">Patent</a></li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="copyright">
              <br>
              <a role="button" target="_blank" href="/admin/reports/department/{{ $department->int_id }}/copyrights_pdf" class="btn btn-primary float-right">
                <i class="fa fa-file"> Generate PDF</i>
              </a>
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th class="text-center">Work Title</th>
                    <th class="text-center">Author - Gender - Type</th>
                    <th class="text-center">Process Status</th>
                    <th class="text-center">Classification</th>
                    <th class="text-center">Date Requested</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($copyrights as $copyright)
                  <tr>
                    <td class="text-center">
                      <a href="#">
                        {{ $copyright->str_project_title }}
                      </a>
                    </td>
                    <td class="text-center">
                      <a href="#">
                        {{ $copyright->str_first_name }} {{ $copyright->str_middle_name }} 
                        {{ $copyright->str_last_name }}
                      </a> - 
                        {{ $copyright->char_gender }} - 
                        {{ $copyright->char_applicant_type }}
                    </td>
                    <td class="text-center">
                      {{ $copyright->char_copyright_status }}
                    </td>
                    <td class="text-center">
                      <a href="/admin/maintenance/project-type/{{ $copyright->int_project_type_id }}">
                        {{ $copyright->char_project_type }}
                      </a>
                    </td>
                    <td class="text-center">
                      {{ date('m/d/Y', strtotime($copyright->created_at)) }}
                    </td>
                  </tr>
                  @empty
                  <div class="alert alert-warning">
                    There is no record yet.
                  </div>
                  @endforelse
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="patent">
            <br>
            <a role="button" target="_blank" href="/admin/reports/department/{{ $department->int_id }}/patents_pdf" class="btn btn-primary float-right">
              <i class="fa fa-file"> Generate PDF</i>
            </a>
            <table class="table table-hover table-bordered" id="">
              <thead>
                <tr>
                  <th class="text-center">Patent Work Title</th>
                  <th class="text-center">Author - Gender - Type</th>
                  <th class="text-center">Process Status</th>
                  <th class="text-center">Classification</th>
                  <th class="text-center">Date Requested</th>
                </tr>
              </thead>
              <tbody>
                @forelse($patents as $patent)
                <tr>
                  <td class="text-center">
                    <a href="#">
                      {{ $patent->str_patent_project_title }}
                    </a>
                  </td>
                  <td class="text-center">
                    <a href="#">
                      {{ $patent->str_first_name }} {{ $patent->str_middle_name }} {{ $patent->str_last_name }}
                    </a> - 
                    {{ $patent->char_gender }} - {{ $patent->char_applicant_type }}
                  </td>
                  <td class="text-center">
                    {{ $patent->char_patent_status }}
                  </td>
                  <td class="text-center">
                    <a href="#">
                      {{ $patent->char_project_type }}
                    </a>
                  </td>
                  <td class="text-center">
                    {{ date('m/d/Y', strtotime($patent->created_at)) }}
                  </td>
                </tr>
                @empty
                  <div class="alert alert-warning">
                    There is no record yet.
                  </div>
                @endforelse
              </tbody>
            </table> 
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>

@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
{{-- Charts --}}
<script type="text/javascript" src="{{ asset('vali/js/plugins/widgets.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/chart.js') }}"></script>
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
      label: "Complete"
    },
    {
      value: 50,
      color:"gray",
      highlight: "#FF5A5E",
      label: "In-Progress"
    },
    {
      value: 85,
      color:"maroon",
      highlight: "#FF5A5E",
      label: "To Process"
    }
  ]
  
  var ctxl = $("#lineChartDemo").get(0).getContext("2d");
  var lineChart = new Chart(ctxl).Line(data);

  var ctxr = $("#radarChartDemo").get(0).getContext("2d");
  var radarChart = new Chart(ctxr).Radar(data);
  
  var ctxpo = $("#polarChartDemo").get(0).getContext("2d");
  var polarChart = new Chart(ctxpo).PolarArea(pdata);
  
  var ctxd = $("#doughnutChartDemo").get(0).getContext("2d");
  var doughnutChart = new Chart(ctxd).Doughnut(pdata);
</script>
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
  $('#sampleTable').DataTable();
  $('#sampleTable2').DataTable();
</script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/bootstrap-datepicker.min.js') }}"></script>
<script>
$('#demoDate').datepicker({
  format: "yyyy-mm-dd",
  autoclose: true,
  todayHighlight: true
});
$('#demoDate2').datepicker({
  format: "yyyy-mm-dd",
  autoclose: true,
  todayHighlight: true
});
</script>
<script>
  $(document).ready(function(){
    $('#li-reports').addClass('is-expanded');
    $('a[href="/admin/reports/departments"]').addClass('active');
  });
</script>
@endsection