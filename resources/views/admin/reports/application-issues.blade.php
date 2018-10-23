@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-envelope"></i> Application Issues</h1>
  <p>Report for issues from project requests</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Reports</li>
<li class="breadcrumb-item"><a href="{{ route('reports.author') }}">Application Issues</a></li>
@endsection

@section('content')
<div class="tile tile-body">
  <h4 align="right">Reports as of today, {{ Carbon\Carbon::now()->format('M d, Y') }}</h4>
  <h5>Date Range</h5>
  {!! Form::open(['action' => 'Report\AuthorController@rangedAuthors', 'method' => 'GET', 'autocomplete' => 'off']) !!}
    @csrf
  <div class="row">
      <div class="col-md-4">
      <label>Start Date</label>
      <input class="form-control" name="dateStart" id="demoDate" type="text" placeholder="Select Date">
      </div>
      <div class="col-md-4">
          <label>End Date</label>
          <input class="form-control" name="dateEnd" id="demoDate2" type="text" placeholder="Select Date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required>    
      </div>
      <div class="col-md-2">
        <br>
        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>Search</button> 
      </div>
      <div class="col-md-2">
        <a role="button" target="_blank" href="/admin/reports/author/authors_pdf" class="btn btn-primary float-right">
          <i class="fa fa-file"> Generate PDF</i>
        </a>
      </div>
  </div>
  {!! Form::close() !!}
</div>
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
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th class="text-center">Work Title</th>
                <th class="text-center">Author - Type</th>
                <th class="text-center">Department - College - Branch</th>
                <th class="text-center">Issue</th>
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
                  <a href="/admin/reports/author/{{ $copyright->applicant->user->id }}">
                  {{ $copyright->applicant->user->str_first_name }} 
                  {{ $copyright->applicant->user->str_last_name }}
                  </a> - {{ $copyright->applicant->char_applicant_type }}
                </td>
                <td class="text-center">
                  <a href="/admin/reports/department/{{ $copyright->applicant->int_department_id }}">
                    {{ $copyright->applicant->department->char_department_code }}
                  </a> - 
                  <a href="/admin/reports/college/{{ $copyright->applicant->department->int_college_id }}">
                    {{ $copyright->applicant->department->college->char_college_code }}
                  </a> - 
                  <a href="/admin/reports/branch/{{ $copyright->applicant->department->college->int_branch_id }}">
                    {{ $copyright->applicant->department->college->branch->str_branch_name }}
                  </a>
                  </td>
                <td class="text-center">
                  @if($copyright->char_copyright_status == 'conflict')
                  Unattended Appointment
                  @elseif($copyright->char_copyright_status == 'to submit/conflict')
                  Incomplete Requirements
                  @endif
                </td>
                <td class="text-center">
                  {{ $copyright->created_at->format('m/d/Y') }}
                </td>
              </tr>
              @empty
              <div class="alert alert-warning">There is no record yet.</div>
              @endforelse
            </tbody>
          </table> 
          </div>
          <div class="tab-pane fade" id="patent">
            <br>
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th class="text-center">Work Title</th>
                <th class="text-center">Author - Type</th>
                <th class="text-center">Department - College - Branch</th>
                <th class="text-center">Issue</th>
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
                  <a href="/admin/reports/author/{{ $patent->copyright->applicant->user->id }}">
                  {{ $patent->copyright->applicant->user->str_first_name }} 
                  {{ $patent->copyright->applicant->user->str_last_name }}
                  </a> - {{ $patent->copyright->applicant->char_applicant_type }}
                </td>
                <td class="text-center">
                  <a href="/admin/reports/department/{{ $patent->copyright->applicant->int_department_id }}">
                    {{ $patent->copyright->applicant->department->char_department_code }}
                  </a> - 
                  <a href="/admin/reports/college/{{ $patent->copyright->applicant->department->int_college_id }}">
                    {{ $patent->copyright->applicant->department->college->char_college_code }}
                  </a> - 
                  <a href="/admin/reports/branch/{{ $patent->copyright->applicant->department->college->int_branch_id }}">
                    {{ $patent->copyright->applicant->department->college->branch->str_branch_name }}
                  </a>
                  </td>
                <td class="text-center">
                  @if($patent->char_patent_status == 'conflict')
                  Unattended Appointment
                  @elseif($patent->char_patent_status == 'to submit/conflict')
                  Incomplete Requirements
                  @endif
                </td>
                <td class="text-center">{{ $patent->created_at->format('d/m/Y') }}</td>
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
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script>$('#sampleTable').DataTable();</script>
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
    $('a[href="/admin/reports/application-issues"]').addClass('active');
  });
</script>
@endsection