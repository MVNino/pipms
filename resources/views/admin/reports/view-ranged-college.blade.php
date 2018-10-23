@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> {{ $college->char_college_code }} Reports</h1>
  <p>Copyright and Patent Statistics as of today, 
    <span class="text-primary">{{ Carbon\Carbon::now()->format('F d') }}</span> 
  </p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Reports</li>
<li class="breadcrumb-item"><a href="{{ route('reports.colleges') }}">Colleges</a></li>
<li class="breadcrumb-item">
  <a href="/admin/reports/college/{{ $college->int_id }}">
    {{ $college->char_college_code }}
  </a>
</li>
@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <h4 class="tile-header text-muted">IPR Records between {{ date('d/m/Y', strtotime($dateStart)) }} and {{ date('d/m/Y', strtotime($dateEnd)) }}</h4>
      <div class="tile-body">
        <ul class="nav nav-tabs">
          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#copyright">Copyright</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#patent">Patent</a></li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="copyright">
              <br>
              <a role="button" target="_blank" href="/admin/reports/college/{{ $college->int_id }}/copyrights_pdf" class="btn btn-primary float-right">
                <i class="fa fa-file"> Generate PDF</i>
              </a>
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th class="text-center">Work Title</th>
                    <th class="text-center">Author - Gender - Type</th>
                    <th class="text-center">Process Status</th>
                    <th class="text-center">Classification</th>
                    <th class="text-center">Department</th>
                    <th class="text-center">Date Requested</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($copyrights as $copyright)
                  <tr>
                    <td class="text-center">
                      @if($copyright->char_copyright_status == 'pending')
                      <a href="/admin/transaction/copyright/pend-request/{{ $copyright->int_id }}">
                      @elseif($copyright->char_copyright_status == 'to submit')                   
                      <a href="/admin/transaction/copyright/to-submit/{{ $copyright->int_id }}">
                      @elseif($copyright->char_copyright_status == 'on process')
                      <a href="/admin/transaction/copyright/on-process/{{ $copyright->int_id }}">
                      @elseif($copyright->char_copyright_status == 'copyrighted')
                      <a href="/admin/reports/copyrighted/{{ $copyright->int_id }}">
                      @elseif($copyright->char_copyright_status == 'conflict')
                      <a href="#">
                      @endif
                        {{ $copyright->str_project_title }}
                      </a>
                    </td>
                    <td class="text-center">
                      <a href="/admin/reports/author/{{ $copyright->author_id }}">
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
                      <a href="/admin/reports/department/{{ $copyright->int_department_id }}">
                        {{ $copyright->char_department_code }}
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
            <a role="button" target="_blank" href="/admin/reports/college/{{ $college->int_id }}/patents_pdf" class="btn btn-primary float-right">
              <i class="fa fa-file"> Generate PDF</i>
            </a>
            <table class="table table-hover table-bordered" id="">
              <thead>
                <tr>
                  <th class="text-center">Patent Work Title</th>
                  <th class="text-center">Author - Gender - Type</th>
                  <th class="text-center">Process Status</th>
                  <th class="text-center">Classification</th>
                  <th class="text-center">Department</th>
                  <th class="text-center">Date Requested</th>
                </tr>
              </thead>
              <tbody>
                @forelse($patents as $patent)
                <tr>
                  <td class="text-center">
                    @if($patent->char_patent_status == 'pending')
                    <a href="/admin/transaction/patent/pend-request/{{ $patent->int_id }}">
                    @elseif($patent->char_patent_status == 'to submit')                   
                    <a href="/admin/transaction/patent/to-submit/{{ $patent->int_id }}">
                    @elseif($patent->char_patent_status == 'on process')
                    <a href="/admin/transaction/patent/on-process/{{ $patent->int_id }}">
                    @elseif($patent->char_patent_status == 'patented')
                    <a href="/admin/reports/patented/{{ $patent->int_id }}">
                    @elseif($patent->char_patent_status == 'conflict')
                    <a href="#">
                    @endif
                      {{ $patent->str_patent_project_title }}
                    </a>
                  </td>
                  <td class="text-center">
                    <a href="/admin/reports/author/{{ $patent->author_id }}">
                      {{ $patent->str_first_name }} {{ $patent->str_middle_name }} {{ $patent->str_last_name }}
                    </a> - 
                    {{ $patent->char_gender }} - {{ $patent->char_applicant_type }}
                  </td>
                  <td class="text-center">
                    {{ $patent->char_patent_status }}
                  </td>
                  <td class="text-center">
                    <a href="/admin/maintenance/project-type/{{ $patent->int_project_type_id }}">
                      {{ $patent->char_project_type }}
                    </a>
                  </td>
                  <td class="text-center">
                    <a href="/admin/reports/department/{{ $patent->int_department_id }}">
                      {{ $patent->char_department_code }}
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
<div class="row">
  <div class="col-md-5">
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
        <div class="row">
          <div class="col-md-10">
            <h4>
              <a href="/admin/maintenance/college/{{ $college->int_id }}">
                {{ $college->char_college_code }}
              </a>
            </h4>
          </div>
          <div class="col-md-2">
            {{-- <p><button type="button" class="btn btn-primary mb-1 float-right" data-toggle="modal" data-target="#modalLong"><i class="fa fa-edit"></i>Edit</button></p> --}}
          </div>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">{{ $college->str_college_name }}</h5>
          <h6 class="card-subtitle text-muted"><a href="/admin/maintenance/branch/{{ $college->branch->int_id }}">{{ $college->branch->str_branch_name }}</a></h6>
        </div>
        <div style="position: relative;">
        <a target="_blank" href="/storage/images/college/banner/{{ $college->str_college_banner_image }}">
        <img style="height: 200px; width: 100%; display: block;" src="/storage/images/college/banner/{{ $college->str_college_banner_image }}" alt="College banner image">
        </a>
          <a target="_blank" href="/storage/images/college/profile/{{ $college->str_college_profile_image }}" style="position: absolute; bottom: -5%; left: 33%;">
              <img class="align-self-center rounded-circle mr-3" style="width:125px; height:125px;" alt="College profile image" src="/storage/images/college/profile/{{ $college->str_college_profile_image }}">
          </a>  
        </div>
        <div class="card-body">
          <label class="card-text text-primary"><h6>Overall</h6></label>
          <div class="row">
            <div class="col-md-3">
              <label class="card-text"><b>Copyrighted: </b></label>  
                <p style="color: maroon;">{{ $iprDataCount['copyrightedCount'][0]->copyrighted_count }}</p>
            </div>
            <div class="col-md-3">
              <label class="card-text"><b>Patented: </b></label>  
                <p style="color: maroon;">{{ $iprDataCount['patentedCount'][0]->patented_count }}</p>
            </div>
            <div class="col-md-3">
              <label class="card-text"><b>Authors: </b></label>  
                <p style="color: maroon;">{{ $iprDataCount['authorCount'][0]->author_count }}</p>
            </div>
            <div class="col-md-3">
              <label class="card-text"><b>Co-Authors: </b></label>  
                <p style="color: maroon;">{{ $iprDataCount['coAuthorCount'][0]->co_author_count }}</p>
            </div>
          </div>
        </div>
        <div class="card-footer text-muted">
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="tile">
      <h3 class="tile-title">{{ $college->char_college_code }} Monthly <small>Copyright / Patent Statistics</small></h3>
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
  <div class="col-md-6">
    <div class="tile">
      <h3 class="tile-title">{{ $college->char_college_code }} Monthly <small>Copyright / Patent Statistics</small></h3>
      <div class="tile-body">
        <div class="embed-responsive embed-responsive-16by9">
          <canvas class="embed-responsive-item" id="barChartDemo23"></canvas>
        </div>
      </div>
      {{-- <div class="tile-footer">
      </div> --}}
    </div>
  </div>
  <div class="col-md-6">
    <div class="tile">
      <h4 class="tile-title">Application <span class="text-danger">Issue</span> Record</h4>
      <div class="tile-body">
        <ul class="nav nav-tabs">
          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#copyrightConf">Copyright</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#patentConf">Patent</a></li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="copyrightConf">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th colspan="4" class="text-center text-primary">
                      Copyright
                    </th>
                  </tr>
                  <tr>
                    <th class="text-center">Author Name</th>
                    <th class="text-center">Department</th>
                    <th class="text-center">Copyright Work Title</th>
                    <th class="text-center">Date Requested</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($copyrightConflicts as $copyright)
                  <tr>
                    <td class="text-center">
                      {{ $copyright->str_first_name }} 
                      {{ $copyright->str_last_name }}
                    </td>
                    <td class="text-center">
                      {{ $copyright->char_department_code }}
                    </td>
                    <td class="text-center">{{ $copyright->str_project_title }}</td>
                    <td class="text-center">{{ $copyright->created_at->format('m/d/Y') }}</td>
                  </tr>
                  @empty
                  <div class="alert alert-warning">
                    There is no record yet.
                  </div>
                  @endforelse
                  {{$copyrightConflicts->links()}}
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="patentConf">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th colspan="4" class="text-center text-primary">
                      Patent
                    </th>
                  </tr>
                  <tr>
                    <th class="text-center">Author Name</th>
                    <th class="text-center">Department</th>
                    <th class="text-center">Patent Work Title</th>
                    <th class="text-center">Date Requested</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($patentConflicts as $patent)
                  <tr>
                    <td class="text-center">
                      {{ $patent->str_first_name }} 
                      {{ $patent->str_last_name }}
                    </td>
                    <td class="text-center">
                      {{ $patent->char_department_code }}
                    </td>
                    <td class="text-center">{{ $patent->str_patent_project_title }}</td>
                    <td class="text-center">{{ $patent->created_at->format('m/d/Y') }}</td>
                  </tr>
                  @empty
                  <div class="alert alert-warning">
                    There is no record yet.
                  </div>
                  @endforelse
                  {{$patentConflicts->links()}}
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="tile">
      <h3 class="tile-title">{{ $college->char_college_code }} to {{ $college->branch->str_branch_name }} branch: 
        <br>Copyright Contribution</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="tile">
      <h3 class="tile-title">{{ $college->char_college_code }} to {{ $college->branch->str_branch_name }} branch: 
        <br>Patent Contribution</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="doughnutChartDemo"></canvas>
      </div>
    </div>
  </div>
  {{-- <div class="col-md-4">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="widget-small primary coloured-icon">
          <a href="/admin/reports/author" style="text-decoration: none;">
            <i class="icon fa fa-users fa-3x"></i>        
          </a>
          <div class="info">
            <h4>Authors</h4>
            <p><span class="count"><b>23</b></span></p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="widget-small primary coloured-icon">
          <a href="/admin/reports/author" style="text-decoration: none;">
            <i class="icon fa fa-users fa-3x"></i>        
          </a>
          <div class="info">
            <h4>Authors</h4>
            <p><span class="count"><b>23</b></span></p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="widget-small primary coloured-icon">
          <a href="/admin/reports/author" style="text-decoration: none;">
            <i class="icon fa fa-users fa-3x"></i>        
          </a>
          <div class="info">
            <h4>Authors</h4>
            <p><span class="count"><b>23</b></span></p>
          </div>
        </div>
      </div>
    </div>
  </div>  --}}
  <div class="col-md-6">
    <div class="tile">
      <h4 class="tile-title">{{ $college->char_college_code }} Departments: Copyright Records</h4>
      <div class="tile-body">
        <table class="table table-hover table-bordered" id="sampleTable">
          <thead>
            <tr>
              <th class="text-center">Department</th>
              <th class="text-center text-success">Copyrighted</th>
              <th class="text-center text-info">On Its Process</th>
              <th class="text-center text-danger">Issues</th>
            </tr>
          </thead>
          <tbody>
            @forelse($departmentCopyrights as $copyright)
            <tr>
              <th class="text-center"><a href="/admin/reports/department/{{ $copyright->int_department_id }}">{{ $copyright->char_department_code }}</a></th>
              <td class="text-center">{{ $copyright->copyrighted_count }}</td>
              <td class="text-center">{{ $copyright->copyright_processing_count }}</td>
              <td class="text-center text-danger">{{ $copyright->copyright_conflict_count }}</td>
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
  <div class="col-md-6">
    <div class="tile">
      <h4 class="tile-title">{{ $college->char_college_code }} Departments: Patent Records</h4>
      <div class="tile-body">
        <table class="table table-hover table-bordered" id="sampleTable">
          <thead>
            <tr>
              <th class="text-center">Department</th>
              <th class="text-center text-success">Patented</th>
              <th class="text-center text-info">On Its Process</th>
              <th class="text-center text-danger">Issues</th>
            </tr>
          </thead>
          <tbody>
            @forelse($departmentPatents as $patent)
            <tr>
              <th class="text-center"><a href="/admin/reports/department/{{ $patent->int_department_id }}">{{ $patent->char_department_code }}</a></th>
              <td class="text-center">{{ $patent->patented_count }}</td>
              <td class="text-center">{{ $patent->patent_processing_count }}</td>
              <td class="text-center text-danger">{{ $patent->patent_conflict_count }}</td>
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
<p id="collegeId" hidden>{{ $college->int_id }}</p>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
{{-- Charts --}}
<script type="text/javascript" src="{{ asset('vali/js/plugins/widgets.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/chart.js') }}"></script>
<script type="text/javascript">
  var linedata = {
    labels: ["January", "February", "March", "April", "May"],
    datasets: [
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

  var ctxl = $("#lineChartDemo").get(0).getContext("2d");
  var lineChart = new Chart(ctxl).Line(linedata);
</script>

{{-- Charts data from database --}}
<script>
( function($) {
  var charts = {
    init: function(){
      this.ajaxGetCollegeCopyrightContribToBranch();
      this.ajaxGetMonthlyIPR();
    },

    ajaxGetCollegeCopyrightContribToBranch: () => {
     var urlPath = 'http://' + '127.0.0.1:8000' + 
      '/admin/reports/college/'+$('#collegeId').text()+'/college_branch_ipr_chart_report';
      var request = $.ajax({
        method: 'GET',
        url: urlPath,
      });
        request.done((response) => {
          // console.log(response);
          charts.copyrightsOfCollegeOverBranch(response);
          charts.patentsOfCollegeOverBranch(response);
        }); 
    },

    copyrightsOfCollegeOverBranch: (response) => {
      var pieData = [
        {
          value: response['branch_copyrights'][0].copyright_count - 
            response['college_copyrights'][0].copyright_count,
          color: "#46BFBD",
          highlight: "#5AD3D1",
          label: "Other colleges of "+response['branch_copyrights'][0].str_branch_name
        },
        {
          value: response['college_copyrights'][0].copyright_count,
          color:"#F7464A",
          highlight: "#FF5A5E",
          label: response['college_copyrights'][0].char_college_code
        }
      ]
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pieData);
    },

    patentsOfCollegeOverBranch: (response) => {
      var doughnutData = [
        {
          value: response['branch_patents'][0].patent_count - 
            response['college_patents'][0].patent_count,
          color: "#46BFBD",
          highlight: "#5AD3D1",
          label: "Other colleges of "+response['branch_patents'][0].str_branch_name
        },
        {
          value: response['college_patents'][0].patent_count,
          color:"#F7464A",
          highlight: "#FF5A5E",
          label: response['college_patents'][0].char_college_code
        }
      ]
      var ctxd = $("#doughnutChartDemo").get(0).getContext("2d");
      var doughnutChart = new Chart(ctxd).Doughnut(doughnutData);
    },

    ajaxGetMonthlyIPR: () => {
     var urlPath = 'http://' + '127.0.0.1:8000' + 
      '/admin/reports/college/'+$('#collegeId').text()+'/college_ipr_chart_report';
      var request = $.ajax({
        method: 'GET',
        url: urlPath,
      });
        request.done((response) => {
          // console.log(response);
          charts.monthlyIPR(response);
        }); 
    },

    monthlyIPR: (response) => {
      var data = {
        labels: response.months,
        datasets: [
          {
            label: "Monthly Copyright Count",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: response.copyright_count_data
          },
          {
            label: "Monthly Patent Count",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: response.patent_count_data
          }
        ]
      };
      var ctxpBar = $("#barChartDemo23").get(0).getContext("2d");
      var barChart23 = new Chart(ctxpBar).Bar(data);
    },

  };

  charts.init();
})( jQuery );
  
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
    $('a[href="/admin/reports/colleges"]').addClass('active');
  });
</script>
@endsection