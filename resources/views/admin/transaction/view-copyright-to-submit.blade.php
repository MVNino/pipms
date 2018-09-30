@extends('admin.layouts.app')

@section('pg-title')
@forelse($copyrightCollection as $copyright)
<h1><i class="fa fa-copyright"></i> {{ $copyright->str_project_title }}</h1>
  <p>A project that needs to submit requirements for copyright registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/copyrights/to-submit">Copyright To Submit</a></li>
<li class="breadcrumb-item"><a href="/admin/transaction/copyright/to-submit/{{ $copyright->int_id }}">{{ $copyright->str_project_title }}</a></li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-7">    
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
        <div class="row">
          <div class="col-md-10">
            <h4>Copyright details</h4>
          </div>
          <div class="col-md-2">
          </div>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title text-muted">Work Title: {{ $copyright->str_project_title }}</h5>
          <h6 class="card-subtitle text-muted">Author: <a href="/admin/maintenance/applicant/{{ $copyright->int_applicant_id }}">{{ $copyright->applicant->user->str_last_name }}, {{ $copyright->applicant->user->str_first_name }} {{ $copyright->applicant->user->str_first_name }}</a> - {{ $copyright->applicant->char_applicant_type }}</h6><br>
          <h6 class="text-muted">Department: <a href="/admin/maintenance/department/{{ $copyright->applicant->int_department_id }}">{{ $copyright->applicant->department->str_department_name }} ({{ $copyright->applicant->department->char_department_code }})</a></h6>
          <h6 class="text-muted">College: <a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">{{ $copyright->applicant->department->college->str_college_name }} ({{ $copyright->applicant->department->college->char_college_code }})</a></h6>
          <h6 class="text-muted">Branch: <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">{{ $copyright->applicant->department->college->branch->str_branch_name }}</a></p>
        

          <p class="text-muted"><strong>Project Type: </strong>{{ $copyright->projectType->char_project_type }}</p>
          <p class="text-muted"><strong>Project Compliance: {{ $copyright->project->str_project_name }}</strong></p>
          <p class="text-muted"><strong>Status: </strong>{{ $copyright->char_copyright_status }}</p>
          <p class="text-muted">Executive Summary: {!! $copyright->mdmTxt_project_description !!}</p>
          @if($copyright->str_exec_summary_file != NULL)
          <p class="text-muted">Executive Summary File:  
          <a href="/storage/summary/copyright/{{ $copyright->str_exec_summary_file }}" target="_blank">
            <i class="fa fa-file"></i> {{ $copyright->str_exec_summary_file }}
          </a>
          </p>
          @endif
          @if($copyright->patent)
          <p class="text-muted"><strong>Patent: </strong><a href="/admin/maintenance/patent/{{ $copyright->patent->int_id }}">{{ $copyright->patent->str_patent_project_title }}</a></p>
          @else
          <p class="text-muted"><strong>Patent: </strong>There is no project application for patent submitted.</p>
          @endif
          @if($copyright->updated_at == $copyright->created_at)
            <p class="text-muted"><strong>Last updated at: </strong>Same as the date it was added.</p>
          @else
          <p class="text-muted"><strong>Last updated at:</strong> {{ $copyright->updated_at }}</p>
          @endif
        </div>
        <div class="card-footer text-muted">
          <div class="row">
            <div class="col-md-7">
              <strong>Date added:</strong> {{ $copyright->created_at }}
            </div>
            <div class="col-md-5">
              <div class="btn-group">
                @if($copyright->char_copyright_status != 'copyrighted')
                <a class="btn btn-primary" href="/admin/transaction/copyright/change-to-submit-to-on-process/{{ $copyright->int_id }}">
                  <i class="fa fa-lg fa-thumbs-up"></i> Complied to requirements</a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="bs-component">
    <div class="card">
      <div class="card-header pb-0">
      <div class="row">
        <div class="col-md-12">
          <h4>Uploaded files</h4>
        </div> 
      </div>
      </div>
      <div class="card-body">
        <div class="bs-component">
          <div class="list-group">
            <div class="row col-md-12">
              <div class="card card-body">
                  <h6>Receipt: {{$copyright->applicant->receipt->char_receipt_code}} - <a target="_blank" href="/storage/images/receipts/{{ $copyright->applicant->receipt->str_receipt_image }}" class="btn btn-link">View attached image</a></h6>  
                  <img style="width: 100%;" src="/storage/images/receipts/{{ $copyright->applicant->receipt->str_receipt_image}}">
              </div>
            </div><br>
            <label class="text-muted">Work Co-Authors: </label>
            @forelse($copyright->applicant->coAuthors as $coAuthor)
              <h6 class="text-muted">{{ $coAuthor->str_first_name }} {{ $coAuthor->str_middle_name }} {{ $coAuthor->str_last_name }}</h6>
            @empty
              <h6 class="text-muted">There is no other authors</h6>
            @endforelse
        </div>
      </div>
      <div class="card-footer text-muted">

      </div>
    </div>
    </div>
  </div>
</div>

@empty
  @include('admin.includes.page-error')
@endforelse
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