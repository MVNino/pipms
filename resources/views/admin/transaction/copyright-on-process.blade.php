@extends('admin.layouts.app')

@section('pg-title')
<h1>On Process Copyright Requests</h1>
  <p>A listing of projects which are on its processs for copyright registration</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/copyrights/on-process">On Process Copyright Requests</a></li>
@endsection

@section('content')
<div class="row">
@forelse($copyrights as $copyright)
<div class="col-md-6">
  <div class="tile">
    <div class="tile-title-w-btn">
      <h3 class="title">{{ $copyright->str_project_title }}</h3>
      <div class="btn-group"><a class="btn btn-primary" href="/admin/transaction/copyright/on-process/{{ $copyright->int_id }}"><i class="fa fa-lg fa-eye"></i> Details</a>
      </div>
    </div>
    <div class="tile-body">
      <strong>Applicant: </strong>{{ $copyright->applicant->user->str_first_name }} {{ $copyright->applicant->user->str_middle_name }} 
      {{ $copyright->applicant->user->str_last_name }} - {{ $copyright->applicant->char_applicant_type }} of <a href="/admin/maintenance/department/{{ $copyright->applicant->int_department_id }}">{{ $copyright->applicant->department->char_department_code }}</a> 
      (<a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">{{ $copyright->applicant->department->college->char_college_code }}</a> - <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">{{ $copyright->applicant->department->college->branch->str_branch_name }}</a>)<br>
    </div>
    <div class="tile-footer">
      <strong>Date complied: </strong>
        @if($copyright->dtm_on_process->diffInYears(Carbon\Carbon::now()) == 0)
          {{ $copyright->dtm_on_process->format('M d - g:i A')}}
        @else
          {{ $copyright->dtm_on_process->format('M d Y - g:i A')}}
        @endif
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
    $('a[href="/admin/transaction/copyrights/on-process"]').addClass('active');
  });
</script>
@endsection