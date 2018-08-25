@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-certificate"></i> On process patents</h1>
  <p>A listing of projects for patent registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/patents/on-process">Patents on process</a></li>
@endsection
@section('content')
<div class="row">
@forelse($patents as $patent)
<div class="col-md-6">
  <div class="tile">
    <div class="tile-title-w-btn">
      <h3 class="title">{{ $patent->str_patent_project_title }}</h3>
      <div class="btn-group"><a class="btn btn-primary" href="/admin/transaction/patent/on-process/{{ $patent->int_id }}"><i class="fa fa-lg fa-eye"></i></a><a class="btn btn-primary" href="#"><i class="fa fa-lg fa-envelope-o"></i></a><a class="btn btn-primary" href="#"><i class="fa fa-lg fa-thumbs-up"></i></a></div>
    </div>
    <div class="tile-body">
      <strong>Applicant: </strong>{{ $patent->copyright->applicant->str_first_name }} {{ $patent->copyright->applicant->str_middle_name }} {{ $patent->copyright->applicant->str_last_name }} - {{ $patent->copyright->applicant->char_applicant_type }} of <a href="/admin/maintenance/department/{{ $patent->copyright->applicant->int_department_id }}">{{ $patent->copyright->applicant->department->char_department_code }}</a> (<a href="/admin/maintenance/college/{{ $patent->copyright->applicant->department->int_college_id }}">{{ $patent->copyright->applicant->department->college->char_college_code }}</a> - <a href="/admin/maintenance/branch/{{ $patent->copyright->applicant->department->college->int_branch_id }}">{{ $patent->copyright->applicant->department->college->branch->str_branch_name }}</a>)<br>
      {!! $patent->mdmTxt_patent_description !!}
    </div>
    <div class="tile-footer">
      <strong>Date requested: </strong>{{ $patent->updated_at }}
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
    $('a[href="/admin/transaction/patents/on-process"]').addClass('active');
  });
</script>
@endsection