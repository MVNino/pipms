@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> {{ $branch->str_branch_name }} Report</h1>
  <p>Copyright and Patent Statistics as of today, 
    <span class="text-primary">{{ Carbon\Carbon::now()->format('F d') }}</span> 
  </p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Reports</li>
<li class="breadcrumb-item"><a href="{{ route('reports.branches') }}">Branches</a></li>
<li class="breadcrumb-item">
  <a href="/admin/reports/branch/{{ $branch->int_id }}">
    {{ $branch->str_branch_name }}
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
              <a href="/admin/maintenance/branch/{{ $branch->int_id }}">
                {{ $branch->str_branch_name }}
              </a>
            </h4>
          </div>
          <div class="col-md-2">
            {{-- <p><button type="button" class="btn btn-primary mb-1 float-right" data-toggle="modal" data-target="#modalLong"><i class="fa fa-edit"></i>Edit</button></p> --}}
          </div>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">{{ $branch->str_branch_name }}</h5>
        </div>
        <div style="position: relative;">
        <a target="_blank" href="/storage/images/branch/banner/{{ $branch->str_branch_banner_image }}">
        <img style="height: 200px; width: 100%; display: block;" src="/storage/images/branch/banner/{{ $branch->str_branch_banner_image }}" alt="Branch banner image">
        </a>
          <a target="_blank" href="/storage/images/branch/profile/{{ $branch->str_branch_profile_image }}" style="position: absolute; bottom: -5%; left: 38%;">
              <img class="align-self-center rounded-circle mr-3" style="width:125px; height:125px;" alt="Branch profile image" src="/storage/images/branch/profile/{{ $branch->str_branch_profile_image }}">
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
      <h3 class="tile-title">{{ $branch->str_branch_name }} Monthly <small>Copyright / Patent Statistics</small></h3>
      <div class="tile-body">
        <div class="embed-responsive embed-responsive-16by9">
          <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
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
              <a role="button" target="_blank" href="/admin/reports/branch/{{ $branch->int_id }}/copyrights_pdf" class="btn btn-primary float-right">
                <i class="fa fa-file"> Generate PDF</i>
              </a>
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th class="text-center">Work Title</th>
                    <th class="text-center">Author - Gender - Type</th>
                    <th class="text-center">Process Status</th>
                    <th class="text-center">Classification</th>
                    <th class="text-center">College - Department</th>
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
                      <a href="/admin/reports/college/{{ $copyright->int_college_id }}">
                        {{ $copyright->char_college_code }}
                      </a> - 
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
            <a role="button" target="_blank" href="/admin/reports/branch/{{ $branch->int_id }}/patents_pdf" class="btn btn-primary float-right">
              <i class="fa fa-file"> Generate PDF</i>
            </a>
            <table class="table table-hover table-bordered" id="">
              <thead>
                <tr>
                  <th class="text-center">Patent Work Title</th>
                  <th class="text-center">Author - Gender - Type</th>
                  <th class="text-center">Process Status</th>
                  <th class="text-center">Classification</th>
                  <th class="text-center">College - Department</th>
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
                    <a href="#">
                      {{ $patent->char_project_type }}
                    </a>
                  </td>
                  <td class="text-center">
                    <a href="/admin/reports/college/{{ $patent->int_college_id }}">
                      {{ $patent->char_college_code }}
                    </a> - 
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
  {{-- colleges of this branch --}}
  <div class="col-md-6">
    <div class="tile">
      <h4 class="tile-title">{{ $branch->str_branch_name }} Colleges: Copyright Records</h4>
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
            @forelse($collegeCopyrights as $copyright)
            <tr>
              <th class="text-center">
                <a href="/admin/reports/college/{{ $copyright->int_college_id }}">
                  {{ $copyright->char_college_code }}
                </a>
              </th>
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
      <h4 class="tile-title">{{ $branch->str_branch_name }} Colleges: Patent Records</h4>
      <div class="tile-body">
        <table class="table table-hover table-bordered" id="sampleTable">
          <thead>
            <tr>
              <th class="text-center">College</th>
              <th class="text-center text-success">Patented</th>
              <th class="text-center text-info">On Its Process</th>
              <th class="text-center text-danger">Issues</th>
            </tr>
          </thead>
          <tbody>
            @forelse($collegePatents as $patent)
            <tr>
              <th class="text-center">
                <a href="/admin/reports/college/{{ $patent->int_college_id }}">
                  {{ $patent->char_college_code }}
                </a>
              </th>
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
<br>
<p id="branchId" hidden>{{ $branch->int_id }}</p>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
{{-- Charts --}}
<script type="text/javascript" src="{{ asset('vali/js/plugins/widgets.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/chart.js') }}"></script>
{{-- Charts data from database --}}
<script>
( function($) {
  var charts = {
    init: function(){
      this.ajaxGetMonthlyIPR();
    },

    ajaxGetMonthlyIPR: () => {
     var urlPath = 'http://' + window.location.hostname + 
      '/admin/reports/branch/'+$('#branchId').text()+'/branch_ipr_chart_report';
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
      var ctxpBar = $("#barChartDemo").get(0).getContext("2d");
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
  $('#sampleTable3').DataTable();
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
    $('a[href="/admin/reports/branches"]').addClass('active');
  });
</script>
@endsection