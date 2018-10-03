@extends('admin.layouts.app')

@section('pg-title')
@forelse($copyrightCollection as $copyright)
<h1>{{ $copyright->str_project_title }}</h1>
  <p>The author must submit requirements for copyright registration</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/copyrights/to-submit">To Submit Requirements</a></li>
<li class="breadcrumb-item"><a href="/admin/transaction/copyright/to-submit/{{ $copyright->int_id }}">{{ $copyright->str_project_title }}</a></li>
@endsection

@section('content')
<div class="row">
  <div class="col-md-7">    
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-md-9">
              <h4>Copyright Details</h4>
            </div>
            <div class="col-md-3">
              <button type="button" class="btn btn-primary mb-1 float-right" data-toggle="modal" data-target="#complianceModal">
                Complied To Requirements
              </button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">Work Title: {{ $copyright->str_project_title }}</h5>
          <label>
            <strong>Author: </strong>
            <a href="/admin/maintenance/applicant/{{ $copyright->int_applicant_id }}">
              {{ $copyright->applicant->user->str_last_name }}, {{ $copyright->applicant->user->str_first_name }} {{ $copyright->applicant->user->str_middle_name }}
            </a> - {{ $copyright->applicant->char_applicant_type }}
          </label><br>
          <label>
            <strong>Department: </strong>
            <a href="/admin/maintenance/department/{{ $copyright->applicant->int_department_id }}">
              {{ $copyright->applicant->department->str_department_name }} ({{ $copyright->applicant->department->char_department_code }})
            </a>
          </label><br>
          <label>
            <strong>College: </strong>
            <a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">
              {{ $copyright->applicant->department->college->str_college_name }} ({{ $copyright->applicant->department->college->char_college_code }})
            </a>
          </label><br>
          <label>
            <strong>Branch: </strong>
            <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">
              {{ $copyright->applicant->department->college->branch->str_branch_name }}
            </a>
          </label><br>
          <label>
            <strong>Type of work: </strong>
            <a href="/admin/maintenance/project-type/{{ $copyright->int_project_type_id }}">
              {{ $copyright->projectType->char_project_type }}
            </a>
          </label><br>
          <label>
            <strong>In compliance with: </strong>
            <a href="/admin/maintenance/project/{{ $copyright->project->int_id }}/{{ $copyright->project->int_department_id }}">
              {{ $copyright->project->str_project_name }}</a>
            </label><br>
          <label>
            <strong>Executive Summary: </strong>
            {!! $copyright->mdmTxt_project_description !!}
          </label>
          <label>
            <strong>Co-Authors: </strong>
          </label>
          <div class="row">
          @forelse($copyright->applicant->coAuthors as $coAuthor)
            <div class="col-md-4">
              <p>
                {{ $coAuthor->str_first_name }} {{ $coAuthor->str_middle_name }} {{ $coAuthor->str_last_name }}
              </p>
            </div>
          @empty
            <h6 class="text-muted">There is no other authors</h6>
          @endforelse
          </div>
          @if($copyright->patent)
          <label>
            <strong>Patent: </strong>
            <a href="/admin/maintenance/patent/{{ $copyright->patent->int_id }}">
              {{ $copyright->patent->str_patent_project_title }}
            </a>
          </label>
          @else
          <label>
            <strong>Patent: </strong>
            <span class="text-info">
              There is no project application for patent submitted.
            </span>
          </label>
          @endif
          <br>
        </div>
        <div class="card-footer text-muted">
          <div class="row">
            <div class="col-md-6">
              <strong>Date added:</strong> 
              @if($copyright->created_at->diffInDays(Carbon\Carbon::now()) == 0)
                @if($copyright->created_at->diffInHours(Carbon\Carbon::now()) > 0)
                  @if($copyright->created_at->diffInHours(Carbon\Carbon::now()) == 1)
                  An hour ago.
                  @else
                  {{ $copyright->created_at->diffInHours(Carbon\Carbon::now()) }} hours ago.
                  @endif
                @else
                  @if($copyright->created_at->diffInMinutes(Carbon\Carbon::now()) <= 1)
                  A minute ago.
                  @else
                  {{ $copyright->created_at->diffInMinutes(Carbon\Carbon::now()) }} minutes ago.
                  @endif
                @endif                    
              @elseif($copyright->created_at->diffInDays(Carbon\Carbon::now()) == 1)
                Yesterday, {{ $copyright->created_at->format('h:i:A') }}
              @elseif($copyright->created_at->diffInDays(Carbon\Carbon::now()) == 2)
                2 days ago at {{ $copyright->created_at->format('h:i:A') }}
              @else
                {{ $copyright->created_at->format('M d, Y')}}
              @endif
            </div>
            <div class="col-md-6">
              <strong>Schedule: </strong>
              @if($copyright->dtm_schedule->diffInDays(Carbon\Carbon::now()) == 0)
                {{-- If today --}}
                Today at {{ $copyright->dtm_schedule->format('g:i A') }}
              @elseif($copyright->dtm_schedule->diffInDays(Carbon\Carbon::now()) == 1)
                {{-- If tomorrow --}}
                Tomorrow at {{ $copyright->dtm_schedule->format('g:i A') }}
              @else
                {{ $copyright->dtm_schedule->format('l, M d') }} at 
                {{ $copyright->dtm_schedule->format('g:i A') }}
              @endif
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
            <div class="card card-body">
              <label>
                <strong>Executive Summary File: </strong>
                <a href="/storage/summary/copyright/{{ $copyright->str_exec_summary_file }}" target="_blank">
                <i class="fa fa-file"></i> {{ $copyright->str_exec_summary_file }}
                </a>
              </label>
              <label>
                <strong>Receipt: </strong>
                {{$copyright->applicant->receipt->char_receipt_code}} - 
                <a target="_blank" href="/storage/images/receipts/{{ $copyright->applicant->receipt->str_receipt_image }}" class="btn btn-link">
                  View attached image
                </a>
              </label>
              <img style="width: 100%;" src="/storage/images/receipts/{{ $copyright->applicant->receipt->str_receipt_image}}">
            </div>
        </div>
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

<!-- Compliance modal -->
<div class="modal fade" id="complianceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Complied to Requirements</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => ['Transaction\ToSubmitController@changeStatusToOnProcess', $copyright->int_id], 
        'method' => 'POST', 'autocomplete' => 'off']) !!}
          @csrf
          Applicant mush have these!
          REQUIREMENTS REMINDER! 
      </div>
      <div class="modal-footer">
          {{ Form::hidden('_method', 'PUT') }}
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Complied</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div> 
<!-- /Compliance modal -->
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/bootstrap-datepicker.min.js') }}"></script>
<script>
$('#demoDate').datepicker({
  format: "yyyy-mm-dd",
  autoclose: true,
  todayHighlight: true
});
</script>
<script>
  $(document).ready(function(){
    $('#li-transaction').addClass('is-expanded');
    $('a[href="/admin/transaction/copyrights/to-submit"]').addClass('active');
  });
</script>
@endsection