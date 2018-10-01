@extends('admin.layouts.app')

@section('pg-title')
@forelse($copyrightCollection as $copyright)
<h1><i class="fa fa-copyright"></i> {{ $copyright->str_project_title }}</h1>
  <p>Form of intellectual property protection</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Records</li>
<li class="breadcrumb-item"><a href="/admin/records/copyrights">Copyrights</a></li>
<li class="breadcrumb-item"><a href="/admin/records/copyright/{{ $copyright->int_id }}">{{ $copyright->str_project_title }}</a></li>
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
          <h6 class="card-subtitle text-muted">Author: <a href="/admin/records/applicant/{{ $copyright->int_applicant_id }}">{{ $copyright->applicant->user->str_last_name }}, {{ $copyright->applicant->user->str_first_name }} {{ $copyright->applicant->user->str_first_name }}</a> - {{ $copyright->applicant->char_applicant_type }}</h6><br>
          <h6 class="text-muted">Department: <a href="/admin/maintenance/department/{{ $copyright->applicant->int_department_id }}">{{ $copyright->applicant->department->str_department_name }} ({{ $copyright->applicant->department->char_department_code }})</a></h6>
          <h6 class="text-muted">College: <a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">{{ $copyright->applicant->department->college->str_college_name }} ({{ $copyright->applicant->department->college->char_college_code }})</a></h6>
          <h6 class="text-muted">Branch: <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">{{ $copyright->applicant->department->college->branch->str_branch_name }}</a></p>
        

          <p class="text-muted"><strong>Project Type: </strong>{{ $copyright->projectType->char_project_type }}</p>
          <p class="text-muted"><strong>Project Compliance: {{ $copyright->project->str_project_name }}</strong></p>
          <p class="text-muted"><strong>Status: </strong>{{ $copyright->char_copyright_status }}</p>
          <p class="text-muted">Executive Summary: {!! $copyright->mdmTxt_project_description !!}</p>
          <p class="text-muted">Executive Summary File:  
          <a href="/storage/summary/copyright/{{ $copyright->str_exec_summary_file }}" target="_blank">
            <i class="fa fa-file"></i> {{ $copyright->str_exec_summary_file }}
          </a>
          </p>
          @if($copyright->patent)
          <p class="text-muted"><strong>Patent: </strong><a href="/admin/records/patent/{{ $copyright->patent->int_id }}">{{ $copyright->patent->str_patent_project_title }}</a></p>
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
            <div class="col-md-2">
            </div>
            <div class="col-md-3">
              <div class="btn-group"><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#exampleModalLong">
                <i class="fa fa-lg fa-envelope-o" data-toggle="modal" data-target="#exampleModalLong"></i> Message</a>
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
        <h6 class="text-muted">Copyright application receipt and project co-authors</h6>
      </div>
    </div>
    </div>
  </div>
</div>

<!-- Edit message modal -->
{{-- <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Message {{ $copyright->applicant->user->str_first_name }} {{ $copyright->applicant->user->str_last_name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => 'TransactionController@messageApplicant', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
          {{Form::label('lblEmail', 'To: ', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtEmail', $copyright->applicant->user->email, ['class' => 'form-control', 'placeholder' => 'Enter email', 'required', 'readonly'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblMessage', 'Message', ['style' => 'font-weight: bold'])}}
          {{Form::textarea('txtAreaBranchDescription', '', ['id' => 'container-form-control article-ckeditor', 'class' => 'form-control', 'placeholder' => "Enter message", 'rows' => '4'])}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i> Send</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>  --}}<!-- /Edit branch modal -->
@empty
  @include('admin.includes.page-error')
@endforelse
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-records').addClass('is-expanded');
    $('a[href="/admin/records/copyrights"]').addClass('active');
  });
</script>
@endsection