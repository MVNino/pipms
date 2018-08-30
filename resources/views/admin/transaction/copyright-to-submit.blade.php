@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-copyright"></i> Requirements Submission for Copyright Registration</h1>
  <p>A listing of projects that needs to submit requirements for copyright registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/copyrights/to-submit">Copyright To Submit</a></li>
@endsection
@section('content')
<div class="row">
@forelse($copyrights as $copyright)
<div class="col-md-6">
  <div class="tile">
    <div class="tile-title-w-btn">
      <h3 class="title">{{ $copyright->str_project_title }}</h3>
      <div class="btn-group"><a class="btn btn-primary" href="/admin/transaction/copyright/to-submit/{{ $copyright->int_id }}"><i class="fa fa-lg fa-eye"></i> View more</a>
      </div>
    </div>
    <div class="tile-body">
      <strong>Applicant: </strong>{{ $copyright->applicant->str_first_name }} {{ $copyright->applicant->str_middle_name }} 
      {{ $copyright->applicant->str_last_name }} - {{ $copyright->applicant->char_applicant_type }} of <a href="/admin/maintenance/department/{{ $copyright->applicant->int_department_id }}">{{ $copyright->applicant->department->char_department_code }}</a> 
      (<a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">{{ $copyright->applicant->department->college->char_college_code }}</a> - <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">{{ $copyright->applicant->department->college->branch->str_branch_name }}</a>)<br>
    </div>
    <div class="tile-footer">
      <strong>Scheduled appointment: </strong>{{ $copyright->dtm_schedule }}
    </div>
  </div>
</div>
@empty
<div class="alert alert-warning">
  There is no record yet.
</div>
@endforelse
</div>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script>
  $(document).ready(function(){
    $('#li-transaction').addClass('is-expanded');
    $('a[href="/admin/transaction/copyrights/to-submit"]').addClass('active');
  });
</script>
@endsection