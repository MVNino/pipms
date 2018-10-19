@extends('admin.layouts.app')

@section('pg-specific-css')
<!-- Timeline CSS -->
<link href="{{asset('elite/css/timeline-vertical-horizontal.css')}}" rel="stylesheet">
@endsection

@section('pg-title')
@forelse($copyrightCollection as $copyright)
<h1><i class="fa fa-copyright"></i> {{ $copyright->str_project_title }}</h1>
  <p>Form of intellectual property protection</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Reports</li>
<li class="breadcrumb-item"><a href="{{ route('reports.copyright') }}">Copyrighted</a></li>
<li class="breadcrumb-item"><a href="/admin/reports/copyrighted/{{ $copyright->int_id }}">{{ $copyright->str_project_title }}</a></li>
@endsection

@section('content')
<div class="tile">
  <div class="tile-body">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#timeline">Timeline</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#view">View</a></li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active show" id="timeline">
          <h3 class="text-muted text-center"><strong>Copyright Timeline</strong></h3>
          <h4 class="text-muted text-center"><strong>({{ $copyright->str_project_title }})</strong></h4>
          <ul class="timeline">
            <li>
                <div class="timeline-badge primary"><i class="fa fa-hand-stop-o"></i></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 class="timeline-title">Copyright Status: <b>Pending</b></h4>
                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$copyright->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                    </div>
                    <div class="timeline-body">
                        <p>Your Application is currently on pending status, and is waiting to have your scheduled appointment with the administrator.</p>
                    </div>
                </div>
            </li>
            <li class="timeline-inverted">
                <div class="timeline-badge success"><i class="fa fa-calendar-check-o"></i> </div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 class="timeline-title">Copyright Status: <b>To submit</b></h4>
                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$copyright->dtm_to_submit)->format('l, jS \of F Y g:i A')}}</small> </p>
                    </div>
                    <div class="timeline-body">
                        <p>Your Document is to be submitted to the National Library.</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="timeline-badge primary"><i class="fa fa-calendar"></i></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 class="timeline-title">Copyright: <b>Scheduled Appointment</b></h4>
                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$copyright->dtm_schedule)->format('l, jS \of F Y g:i A')}}</small> </p>
                    </div>
                    <div class="timeline-body">
                        <p>Scheduled appointment of application for copyright registration.</p>
                    </div>
                </div>
            </li>
            <li class="timeline-inverted">
                <div class="timeline-badge danger"><i class="fa fa-building-o"></i></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 class="timeline-title">Copyright Status: <b>On process</b></h4>
                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$copyright->dtm_on_process)->format('l, jS \of F Y g:i A')}}</small> </p>
                    </div>
                    <div class="timeline-body">
                        <p>Your document is now on process.</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="timeline-badge info"><i class="fa fa-copyright"></i></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 class="timeline-title">Copyright Status: <b>Copyrighted</b></h4>
                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$copyright->dtm_copyrighted)->format('l, jS \of F Y g:i A')}}</small> </p>
                    </div>
                    <div class="timeline-body">
                        <p>Your document is already copyrighted. </p>
                    </div>
                </div>
            </li>
          </ul>
        </div>
        <div class="tab-pane fade" id="view">
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
                       {{--  <button type="button" class="btn btn-primary mb-1 float-right" data-toggle="modal" data-target="#toApproveModalLong">
                          <i class="fa fa-fw fa-lg fa-envelope"></i> Message
                        </button> --}}
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
                          {{ $copyright->created_at->format('M d Y')}}
                        @endif
                      </div>
                      <div class="col-md-6">
                        @if($copyright->updated_at == $copyright->created_at)
                        @else
                          <strong>Date copyrighted: </strong>
                          @if($copyright->dtm_copyrighted->diffInDays(Carbon\Carbon::now()) == 0)
                            @if($copyright->dtm_copyrighted->diffInHours(Carbon\Carbon::now()) > 0)
                              @if($copyright->dtm_copyrighted->diffInHours(Carbon\Carbon::now()) == 1)
                              An hour ago.
                              @else
                              {{ $copyright->dtm_copyrighted->diffInHours(Carbon\Carbon::now()) }} hours ago.
                              @endif
                            @else
                              @if($copyright->dtm_copyrighted->diffInMinutes(Carbon\Carbon::now()) <= 1)
                              A minute ago.
                              @else
                              {{ $copyright->dtm_copyrighted->diffInMinutes(Carbon\Carbon::now()) }} minutes ago.
                              @endif
                            @endif                    
                          @elseif($copyright->dtm_copyrighted->diffInDays(Carbon\Carbon::now()) == 1)
                            Yesterday, {{ $copyright->dtm_copyrighted->format('h:i:A') }}
                          @elseif($copyright->dtm_copyrighted->diffInDays(Carbon\Carbon::now()) == 2)
                            2 days ago at {{ $copyright->dtm_copyrighted->format('h:i:A') }}
                          @else
                            {{ $copyright->dtm_copyrighted->format('M d')}}
                          @endif
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
                        @else
                        <label class="text-info">
                          There is no uploaded executive summary file
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
              </div>
              </div>
            </div>
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
<script src="{{ asset('elite/js/custom.min.js') }}"></script>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<script src="../assets/node_modules/popper/popper.min.js"></script>
<script>
  $(document).ready(function(){
    $('#li-reports').addClass('is-expanded');
    $('a[href="/admin/reports/copyright"]').addClass('active');
  });
</script>
@endsection