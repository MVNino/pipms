@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-certificate"></i> Pending patent requests</h1>
  <p>A listing of projects for patent registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/patents/pend-request">Patents Pending Requests</a></li>
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
  @forelse($patents as $patent)
  <div class="tile tile-body mb-2">
    <div class="row">
      <div class="col-md-3">{{ $patent->str_patent_project_title }}</div>
      <div class="col-md-5">{{ $patent->copyright->applicant->user->str_first_name }} {{ $patent->copyright->applicant->user->str_last_name }} - {{ $patent->copyright->applicant->char_applicant_type }} of <a href="/admin/maintenance/department/{{ $patent->copyright->applicant->int_department_id }}">{{ $patent->copyright->applicant->department->char_department_code }}</a> - <a href="/admin/maintenance/college/{{ $patent->copyright->applicant->department->int_college_id }}">{{ $patent->copyright->applicant->department->college->char_college_code }}</a> - <a href="/admin/maintenance/branch/{{ $patent->copyright->applicant->department->college->int_branch_id }}">{{ $patent->copyright->applicant->department->college->branch->str_branch_name }}</a></div>
      <div class="col-md-2">{{ $patent->created_at }}</div>
      <div class="col-md-2"><a class="btn btn-primary" href="/admin/transaction/patent/pend-request/{{ $patent->int_id }}"><i class="fa fa-eye"></i> View</a></div>
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
    $('a[href="/admin/transaction/patents/pend-request"]').addClass('active');
  });
</script>
@endsection