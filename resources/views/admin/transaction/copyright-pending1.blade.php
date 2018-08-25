@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-copyright"></i> Pending Requests for Copyright</h1>
  <p>A listing of projects which requests for copyright registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/copyrights/pend-request">Copyright Pending Requests</a></li>
@endsection
@section('content')
  <div class="tile tile-body mb-2 bg-secondary" style="color: #f3f3f3;">
    <div class="row">
      <div class="col-md-3">Project/Work Title</div>
      <div class="col-md-5">Applicant - Type - Department - College - Branch</div>
      <div class="col-md-2">Date requested</div>
      <div class="col-md-2">View more details</div>
    </div>
  </div>
  @forelse($copyrights as $copyright)
  <div class="tile tile-body mb-2">
    <div class="row">
      <div class="col-md-3"><strong>{{ $copyright->str_project_title }}</strong></div>
      <div class="col-md-5"><strong>{{ $copyright->applicant->str_first_name }} {{ $copyright->applicant->str_last_name }}</strong> - {{ $copyright->applicant->char_applicant_type }} of <a href="/admin/maintenance/department/{{ $copyright->applicant->int_department_id }}">{{ $copyright->applicant->department->char_department_code }}</a> - <a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">{{ $copyright->applicant->department->college->char_college_code }}</a> - <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">{{ $copyright->applicant->department->college->branch->str_branch_name }}</a></div>
      <div class="col-md-2">{{ $copyright->created_at }}</div>
      <div class="col-md-2"><a class="btn btn-primary" href="/admin/transaction/copyright/pend-request/{{ $copyright->int_id }}"><i class="fa fa-eye"></i> View</a></div>
    </div>
  </div>
  @empty
  @endforelse
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script>
  $(document).ready(function(){
    $('#li-transaction').addClass('is-expanded');
    $('a[href="/admin/transaction/copyrights/pend-request"]').addClass('active');
  });
</script>
@endsection