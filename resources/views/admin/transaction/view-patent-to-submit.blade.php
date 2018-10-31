@extends('admin.layouts.app')

@section('pg-title')
@forelse($patentCollection as $patent)
<h1>{{ $patent->str_patent_project_title }}</h1>
  <p>The author must submit requirements for copyright registration</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/patents/to-submit">To Submit Requirements</a></li>
<li class="breadcrumb-item"><a href="/admin/transaction/patent/to-submit/{{ $patent->int_id }}">{{ $patent->str_patent_project_title }}</a></li>
@endsection

@section('content')
<div class="row">
  <div class="col-md-6">    
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-md-9">
              <h5>Schedule: 
              @if($patent->dtm_schedule->diffInDays(Carbon\Carbon::now()) == 0)
                {{-- If today --}}
                Today at {{ $patent->dtm_schedule->format('g:i A') }}
              @elseif($patent->dtm_schedule->diffInDays(Carbon\Carbon::now()) == 1)
                {{-- If tomorrow --}}
                Tomorrow at {{ $patent->dtm_schedule->format('g:i A') }}
              @else
                {{ $patent->dtm_schedule->format('l, M d') }} at 
                {{ $patent->dtm_schedule->format('g:i A') }}
              @endif
              </h5>
            </div>
            <div class="col-md-3">
              @if(!$patent->dtm_start || ($patent->char_patent_status == 'to submit/conflict' && $patent->dtm_start))
                {{-- Display timer button --}}
                {!! Form::open(['id' => 'formTimer','action' => ['Transaction\ToSubmitController@toSubmitPatentTimer', $patent->int_id], 'method' => 'POST']) !!}
                  @csrf
                  {{ Form::hidden('_method', 'PUT') }}
                  <button type="button" id="demoSwal" class="btn btn-primary mb-1 float-right">
                    <i class="fa fa-clock-o"></i> Checking of Requirements
                  </button>
                {!! Form::close() !!}
              @else
                <button type="button" class="btn btn-primary mb-1 float-right" data-toggle="modal" data-target="#complianceModal">
                  Checking of Requirements
                </button>
              @endif
            </div>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">Work Title: {{ $patent->str_patent_project_title }}</h5>
          <label><strong>Type of Work: </strong>{{ $patent->projectType->char_project_type }}</label><br>
          <label><strong>In compliance with: </strong>{{ $patent->project->str_project_name }}</label><br>
          <label><strong>Abstract of the Disclosure: </strong>{!! $patent->mdmTxt_patent_description !!}</label><br>
          <label><strong>Abstract of the Disclosure File: </strong>
            @if($patent->str_patent_summary_file != NULL)
              <a href="/storage/summary/patent/{{ $patent->str_patent_summary_file }}" target="_blank">
                <i class="fa fa-file"></i> {{ $patent->str_patent_summary_file }}
              </a>
            @else
              <span class="text-info">There is no summary file attached</span>
            @endif
          </label><br>
          <label><strong>Copyright Record: </strong>
            @if($patent->copyright->char_copyright_status == 'pending')
              <a href="/admin/transaction/copyright/pend-request/{{ $patent->copyright->int_id }}">
                {{ $patent->copyright->str_project_title }}
              </a>
            @elseif($patent->copyright->char_copyright_status == 'to submit')
              <a href="/admin/transaction/copyright/to-submit/{{ $patent->copyright->int_id }}">
                {{ $patent->copyright->str_project_title }}
              </a>
            @elseif($patent->copyright->char_copyright_status == 'on process')
              <a href="/admin/transaction/copyright/on-process/{{ $patent->copyright->int_id }}">
                {{ $patent->copyright->str_project_title }}
              </a>
            @else
              <a href="/admin/reports/copyrighted/{{ $patent->copyright->int_id }}">
                {{ $patent->copyright->str_project_title }}
              </a>
            @endif
            <span class="text-muted">
              ({{ $patent->copyright->char_copyright_status }})
            </span>
          </label>
        </div>
        <div class="card-footer text-muted">
          <div class="row">
            <div class="col-md-12">
              <strong>Date added: </strong> 
              @if($patent->created_at->diffInDays(Carbon\Carbon::now()) == 0)
                @if($patent->created_at->diffInHours(Carbon\Carbon::now()) > 0)
                  @if($patent->created_at->diffInHours(Carbon\Carbon::now()) == 1)
                  An hour ago.
                  @else
                  {{ $patent->created_at->diffInHours(Carbon\Carbon::now()) }} hours ago.
                  @endif
                @else
                  @if($patent->created_at->diffInMinutes(Carbon\Carbon::now()) <= 1)
                  A minute ago.
                  @else
                  {{ $patent->created_at->diffInMinutes(Carbon\Carbon::now()) }} minutes ago.
                  @endif
                @endif                    
              @elseif($patent->created_at->diffInDays(Carbon\Carbon::now()) == 1)
                Yesterday, {{ $patent->created_at->format('h:i:A') }}
              @elseif($patent->created_at->diffInDays(Carbon\Carbon::now()) == 2)
                2 days ago at {{ $patent->created_at->format('h:i:A') }}
              @else
                {{ $patent->created_at->format('F d, Y')}}
              @endif
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
          <h4>Applicant Details</h4>
      </div>
      <div class="card-body">
        <div class="card card-body">
          <label>
            <strong>Author: </strong>
            <a href="/admin/records/applicant/{{ $patent->copyright->int_applicant_id }}">
              {{ $patent->copyright->applicant->user->str_last_name }}, 
              {{ $patent->copyright->applicant->user->str_first_name }} 
              {{ $patent->copyright->applicant->user->str_middle_name }}</a> -
              @if($patent->copyright->applicant->char_gender == 'F')
                Female - 
              @else
                Male - 
              @endif
              {{ $patent->copyright->applicant->char_applicant_type }}
          </label>
          <label><strong>Email Address: </strong>{{ $patent->copyright->applicant->user->email }}</label>
          <label><strong>Cellphone Number: </strong>{{ $patent->copyright->applicant->bigInt_cellphone_number }}</label>
          <label><strong>Telephone Number: </strong>{{ $patent->copyright->applicant->mdmInt_telephone_number }}</label>
          <label>
            <strong>Department: </strong>
            <a href="/admin/maintenance/department/{{ $patent->copyright->applicant->int_department_id }}">
              {{ $patent->copyright->applicant->department->str_department_name }} 
              ({{ $patent->copyright->applicant->department->char_department_code }})
            </a>
          </label>
          <label>
            <strong>College: </strong>
            <a href="/admin/maintenance/college/{{ $patent->copyright->applicant->department->int_college_id }}">
              {{ $patent->copyright->applicant->department->college->str_college_name }} 
              ({{ $patent->copyright->applicant->department->college->char_college_code }})
            </a>
          </label>
          <label>
            <strong>Branch: </strong>
            <a href="/admin/maintenance/branch/{{ $patent->copyright->applicant->department->college->int_branch_id }}">
              {{ $patent->copyright->applicant->department->college->branch->str_branch_name }}
            </a>
          </label><br>
          <label>
            <strong>Co-Authors: </strong>
          </label>
          <div class="row">
          @forelse($patent->copyright->applicant->coAuthors as $coAuthor)
            <div class="col-md-4">
              <p>
                {{ $coAuthor->str_first_name }} {{ $coAuthor->str_middle_name }} {{ $coAuthor->str_last_name }}
              </p>
            </div>
          @empty
            <h6 class="text-muted">There is no other authors</h6>
          @endforelse
          </div>
        </div>
      </div>      
      <div class="card-footer text-muted">
      </div>
    </div>
    </div>
  </div>
</div>

<!-- Compliance modal -->
<div class="modal fade" id="complianceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Checking of Requirements <br><small class="text-info">Time Started: {{ date('g:i A', strtotime($patent->dtm_start)) }}</small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p class="text-muted">The applicant must have the following requirements 
            for their work's patent registration: </p>
          <div class="bs-component">
            <div class="list-group">
              @foreach($requirements as $requirement)
              <div class="form-group form-check list-group-item list-group-item-action">
                <!--Checkbox Markup-->
                <div class="animated-checkbox">
                  <label>
                    <input name="checkRequirement_{{ $requirement->int_id }}" id="idRequirement_3" type="checkbox" checked><span class="label-text">{{ $requirement->str_requirement }}</span>
                  </label>
                </div>
              </div>
              @endforeach
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        {!! Form::open(['id' => 'formOnProcess', 'action' => ['Transaction\ToSubmitController@changePatentStatusToOnProcess', $patent->int_id], 
        'method' => 'POST', 'autocomplete' => 'off']) !!}
          @csrf
        {{ Form::hidden('_method', 'PUT') }}
          <button type="button" id="btnOk" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Proceed</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div> 
<!-- /Compliance modal -->

{{-- Reschedule Modal --}}
<div class="modal fade" id="reSchedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongReSched" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongReSched">Appointment Reschedule <br><small class="text-info">Time Started: {{ date('g:i A', strtotime($patent->dtm_start)) }}</small>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
 
      {!! Form::open(['action' => 'Transaction\ToSubmitController@patentIncompleteRequirements', 
        'method' => 'POST', 'autocomplete' => 'off']) !!}
        @csrf
        <label>It seems the client didn't bring all the requirements. 
          <br>Set date and time for his appointment reschedule.
        </label>              
        <input type="text" name="patentId" value="{{ $patent->int_id }}" hidden readonly>               
        <div class="form-group">
          <label class="form-label" for="demoDate">Date</label>
          <input class="form-control" name="dateSchedule" id="demoDate" type="text" placeholder="Select Date" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="timeScheduleId">Time</label>
          <input type="time" name="timeSchedule" id="timeScheduleId" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Set</button>
      </div>
      {!! Form::close() !!} 
    </div>
  </div>
</div>
{{-- /Reschedule Modal --}}
@empty
  @include('admin.includes.page-error')
@endforelse
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script>
  $('#btnOk').click((e) => {

    if ($("#idRequirement_3").is(":checked")) {
        // proceed record to on process
          $("#formOnProcess").submit();
    }
    else {
      e.preventDefault();
      $('#complianceModal')
          .modal('hide')
          .on('hidden.bs.modal', function (e) {
              $('#reSchedModal').modal('show');
              $(this).off('hidden.bs.modal'); // Remove the 'on' event binding
          });
    }
  });
</script>

{{-- Sweet Alert --}}
<script src="{{ asset('vali/js/plugins/sweetalert.min.js') }}"></script>
<script>
$('#demoSwal').click(function(){
  swal({
    title: "Activate timer?",
    text: "To proceed to the checking of requirements.",
    type: "info",
    showCancelButton: true,
    confirmButtonText: "Yes!",
    cancelButtonText: "Cancel",
    closeOnConfirm: false,
    closeOnCancel: false
  }, function(isConfirm) {
    if (isConfirm) {
      $('#formTimer').submit();
      swal("Timer Activated", "You can now proceed to the checking of requirements.", "success");
    } else {
      swal("Cancelled", "The action has been cancelled!", "error");
    }
  });
});
</script>
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
    $('a[href="/admin/transaction/patents/to-submit"]').addClass('active');
  });
</script>
@endsection