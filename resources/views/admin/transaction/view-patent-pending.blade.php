@extends('admin.layouts.app')

@section('pg-title')
@forelse($patentCollection as $patent)
<h1><i class="fa fa-certificate"></i> {{ $patent->str_patent_project_title }}</h1>
  <p>A listing of projects for patent registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/patents/pend-request">Pending patent requests</a></li>
<li class="breadcrumb-item"><a href="/admin/transaction/patent/pend-request/{{ $patent->int_id }}">{{ $patent->str_patent_project_title }}</a></li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-6">    
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
        <div class="row">
          <div class="col-md-10">
            <h4>Patent details</h4>
          </div>
          <div class="col-md-2">
          </div>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title text-muted">Work Title: {{ $patent->str_patent_project_title }}</h5>
          <p class="text-muted"><strong>Project Type: </strong>{{ $patent->copyright->projectType->char_project_type }}</p>
          <p class="text-muted"><strong>Project Compliance: {{ $patent->project->str_project_name }}</strong></p>
          <p class="text-muted"><strong>Status: </strong>{{ $patent->char_patent_status }}</p>
          <p class="text-muted">Executive Summary: {!! $patent->mdmTxt_patent_description !!}</p>
          <p class="text-muted"><strong>Copyright: </strong><a href="/admin/transaction/copyright/{{ $patent->copyright->int_id }}">{{ $patent->copyright->str_project_title }}</a></p>
          @if($patent->updated_at == $patent->created_at)
            <p class="text-muted"><strong>Last updated at: </strong>Same as the date it was added.</p>
          @else
          <p class="text-muted"><strong>Last updated at:</strong> {{ $patent->updated_at }}</p>
          @endif
        </div>
        <div class="card-footer text-muted">
          <div class="row">
            <div class="col-md-8">
              <strong>Date added:</strong> {{ $patent->created_at }}
            </div>
            <div class="col-md-4">
              <div class="btn-group">
                @if($patent->char_patent_status != 'patented')
                <button class="btn btn-primary"><i class="fa fa-lg fa-calendar" data-toggle="modal" data-target="#approveModalLong"></i> Set appointment</button>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="bs-component">
    <div class="card">
      <div class="card-header pb-0">
          <h4>Applicant details</h4>
      </div>
      <div class="card-body">
        <div class="bs-component">
          <p class="card-subtitle text-muted">Author: <a href="/admin/records/applicant/{{ $patent->copyright->int_applicant_id }}">{{ $patent->copyright->applicant->user->str_last_name }}, {{ $patent->copyright->applicant->user->str_first_name }} {{ $patent->copyright->applicant->user->str_middle_name }}</a> - {{ $patent->copyright->applicant->char_gender }} - {{ $patent->copyright->applicant->char_applicant_type }}</p>
          <p class="text-muted">Email Address: {{ $patent->copyright->applicant->user->email }}</p>
          <p class="text-muted">Cellphone Number: {{ $patent->copyright->applicant->bigInt_cellphone_number }}</p>
          <p class="text-muted">Telephone Number: {{ $patent->copyright->applicant->mdmInt_telephone_number }}</p>
          <p class="text-muted">Department: <a href="/admin/maintenance/department/{{ $patent->copyright->applicant->int_department_id }}">{{ $patent->copyright->applicant->department->str_department_name }} ({{ $patent->copyright->applicant->department->char_department_code }})</a></p>
          <p class="text-muted">College: <a href="/admin/maintenance/college/{{ $patent->copyright->applicant->department->int_college_id }}">{{ $patent->copyright->applicant->department->college->str_college_name }} ({{ $patent->copyright->applicant->department->college->char_college_code }})</a></p>
          <p class="text-muted">Branch: <a href="/admin/maintenance/branch/{{ $patent->copyright->applicant->department->college->int_branch_id }}">{{ $patent->copyright->applicant->department->college->branch->str_branch_name }}</a></p>
         <br>
          <label class="text-muted">Work Co-Authors: </label>
          @forelse($patent->copyright->applicant->coAuthors as $coAuthor)
            <p class="text-muted">{{ $coAuthor->str_first_name }} {{ $coAuthor->str_last_name }}</p>
          @empty
            <p class="text-muted">There is no co-author.</p>
          @endforelse
        </div>
      </div>      
      <div class="card-footer text-muted">
      </div>
    </div>
    </div>
  </div>
</div>

<!-- Approve modal -->
<div class="modal fade" id="approveModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Set appointment for actual application</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => ['TransactionController@setScheduleForPatent', $patent->int_id], 'method' => 'POST']) !!}
        <div class="row">
          
        <div class="col-md-8 col-sm-8">
          <label><strong>Set schedule</strong></label><br>  
          <input type="date" name="dateSchedule">
          <input type="time" name="timeSchedule">
        </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-8">
            @if($patent->copyright->dtm_schedule != NULL)
            <label><strong>Schedule for actual submission of copyright requirements: {{ $patent->copyright->dtm_schedule }}</strong></label><br>
            @endif
          </div>
        </div>
        <div class="modal-footer">
          {{ Form::hidden('_method', 'PUT') }}
          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-thumbs-up"></i> Set different schedule</button>
          <a role="button" class="btn btn-info" href="/admin/transaction/same-sched/{{$patent->int_id}}"><i class="fa fa-fw fa-lg fa-copyright"></i> Clone copyright appointment</a>
        </div>
          @csrf
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div> <!-- /Approve modal -->
@empty
  @include('admin.includes.page-error')
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