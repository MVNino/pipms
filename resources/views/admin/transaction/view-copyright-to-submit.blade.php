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
              <h5>Schedule: 
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
              </h5>
            </div>
            <div class="col-md-3">
              @if(!$copyright->dtm_start || ($copyright->char_copyright_status == 'to submit/conflict' && $copyright->dtm_start))
                {{-- Display timer button --}}
                {!! Form::open(['id' => 'formTimer','action' => ['Transaction\ToSubmitController@toSubmitCopyrightTimer', $copyright->int_id], 'method' => 'POST']) !!}
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
            <strong>Type of Work: </strong>
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
            @if($copyright->patent->char_patent_status == 'pending')
              <a href="/admin/transaction/patent/pend-request/{{ $copyright->patent->int_id }}">
                {{ $copyright->patent->str_patent_project_title }}
              </a>
            @elseif($copyright->patent->char_patent_status == 'to submit')
              <a href="/admin/transaction/patent/to-submit/{{ $copyright->patent->int_id }}">
                {{ $copyright->patent->str_patent_project_title }}
              </a>
            @elseif($copyright->patent->char_patent_status == 'on-process')
              <a href="/admin/transaction/patent/on-process/{{ $copyright->patent->int_id }}">
                {{ $copyright->patent->str_patent_project_title }}
              </a>
            @else
              <a href="/admin/reports/patented/{{ $copyright->patent->int_id }}">
                {{ $copyright->patent->str_patent_project_title }}
              </a>
            @endif
            <span class="text-muted">
              ({{ $copyright->patent->char_patent_status }})
            </span>
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
                {{ $copyright->created_at->format('F d, Y')}}
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
          <h4>Uploaded Files</h4>
        </div> 
      </div>
      </div>
      <div class="card-body">
        <div class="bs-component">
          <div class="list-group">
            <div class="card card-body">
              @if($copyright->str_exec_summary_file)
              <label>
                <strong>Executive Summary File: </strong>
                <a href="/storage/summary/copyright/{{ $copyright->str_exec_summary_file }}" target="_blank">
                <i class="fa fa-file"></i> {{ $copyright->str_exec_summary_file }}
                </a>
              </label>
              @endif
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

<!-- Compliance modal -->
<div class="modal fade" id="complianceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Checking of Requirements <br><small class="text-info">Time Started: {{ date('g:i A', strtotime($copyright->dtm_start)) }}</small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p class="text-muted">The applicant must have the following requirements 
            for their work's copyright registration: </p>
          <div class="bs-component">
            <div class="list-group">
              @foreach($requirements as $requirement)
              <div class="form-group form-check list-group-item list-group-item-action">
                <!--Checkbox Markup-->
                <div class="animated-checkbox">
                  <label>
                    <input name="checkRequirement_{{ $requirement->int_id }}" id="idRequirement_{{ $requirement->int_id }}" type="checkbox" checked><span class="label-text">{{ $requirement->str_requirement }}</span>
                  </label>
                </div>
              </div>
              @endforeach
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        {!! Form::open(['id' => 'formOnProcess', 'action' => ['Transaction\ToSubmitController@changeStatusToOnProcess', $copyright->int_id], 
      'method' => 'POST']) !!}
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
        <h5 class="modal-title" id="exampleModalLongReSched">Appointment Reschedule <br><small class="text-info">Time Started: {{ date('g:i A', strtotime($copyright->dtm_start)) }}</small>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
 
      {!! Form::open(['action' => 'Transaction\ToSubmitController@incompleteRequirements', 
        'method' => 'POST', 'autocomplete' => 'off']) !!}
        @csrf
        <label>It seems the client didn't bring all the requirements. 
          <br>Set date and time for his appointment reschedule.
        </label>              
        <input type="text" name="copyrightId" value="{{ $copyright->int_id }}" hidden readonly>               
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
    // if ($('#idRequirement_1').attr('checked', false)) {
    //   console.log('unchecked siya ihh!');
    // }
    var requirement1 = $("#idRequirement_1").val();
    var requirement2 = $("#idRequirement_2").val();
    var requirement4 = $("#idRequirement_4").val();
    var requirement5 = $("#idRequirement_5").val();
    var requirement6 = $("#idRequirement_6").val();
    var requirement7 = $("#idRequirement_7").val();
    var requirement8 = $("#idRequirement_8").val();

    if ($("#idRequirement_1").is(":checked") && $("#idRequirement_2").is(":checked") && $("#idRequirement_4").is(":checked") && $("#idRequirement_5").is(":checked") && $("#idRequirement_6").is(":checked") && $("#idRequirement_7").is(":checked") && $("#idRequirement_8").is(":checked")) {
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

    // $("#btnReschedule").click((e) => {
    //   e.preventDefault();
    //   var copyrightId = $(#copyrightId).val();
    //   var dateSchedule = $(#dateSchedule).val();
    //   var timeSchedule = $(#timeSchedule).val();
    //   $.post('/admin/transaction/copyright/to-submit/incomplete', {
    //     'copyrightId': copyrightId, 
    //     'dateSchedule': dateSchedule, 
    //     'timeSchedule': timeSchedule,
    //     '_token': $("input[name=token]").val()
    //     }, 
    //     function(data){
    //       console.log(data);
    //     } 

    //   );
    // });

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
    $('a[href="/admin/transaction/copyrights/to-submit"]').addClass('active');
  });
</script>
@endsection