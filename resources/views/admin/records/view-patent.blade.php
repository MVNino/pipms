@extends('admin.layouts.app')

@section('pg-title')
@forelse($patentCollection as $patent)
<h1><i class="fa fa-certificate"></i> {{ $patent->str_patent_project_title }}</h1>
  <p>An exclusive right granted for an invention</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Records</li>
<li class="breadcrumb-item"><a href="/admin/records/patents">Patents</a></li>
<li class="breadcrumb-item"><a href="/admin/records/patent/{{ $patent->int_id }}">{{ $patent->str_patent_project_title }}</a></li>
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
          <p class="text-muted"><strong>Project Compliance: </strong></p>
          <p class="text-muted"><strong>Status: </strong>{{ $patent->char_patent_status }}</p>
          <p class="text-muted">Executive Summary: {!! $patent->mdmTxt_patent_description !!}</p>
          
          <p class="text-muted"><strong>Copyright: </strong><a href="/admin/records/copyright/{{ $patent->copyright->int_id }}">{{ $patent->copyright->str_project_title }}</a></p>
          @if($patent->updated_at == $patent->created_at)
            <p class="text-muted"><strong>Last updated at: </strong>Same as the date it was added.</p>
          @else
          <p class="text-muted"><strong>Last updated at:</strong> {{ $patent->updated_at }}</p>
          @endif
        </div>
        <div class="card-footer text-muted">
          <div class="row">
            <div class="col-md-7">
              <strong>Date added:</strong> {{ $patent->created_at }}
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-3">
              <div class="btn-group">
                @if($patent->char_patent_status != 'Patented')
                <a class="btn btn-primary" href="/admin/transaction/patent/change-on-process-to-patented/{{ $patent->int_id }}">
                  <i class="fa fa-lg fa-thumbs-up"></i></a>
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
          <p class="card-subtitle text-muted">Author: <a href="/admin/records/applicant/{{ $patent->copyright->int_applicant_id }}">{{ $patent->copyright->applicant->str_last_name }}, {{ $patent->copyright->applicant->str_first_name }} {{ $patent->copyright->applicant->str_middle_name }}</a> - {{ $patent->copyright->applicant->char_gender }} - {{ $patent->copyright->applicant->char_applicant_type }}</p>
          <p class="text-muted">Email Address: {{ $patent->copyright->applicant->str_email_address }}</p>
          <p class="text-muted">Cellphone Number: {{ $patent->copyright->applicant->bigInt_cellphone_number }}</p>
          <p class="text-muted">Telephone Number: {{ $patent->copyright->applicant->mdmInt_telephone_number }}</p>
          <p class="text-muted">Department: <a href="/admin/maintenance/department/{{ $patent->copyright->applicant->int_department_id }}">{{ $patent->copyright->applicant->department->str_department_name }} ({{ $patent->copyright->applicant->department->char_department_code }})</a></p>
          <p class="text-muted">College: <a href="/admin/maintenance/college/{{ $patent->copyright->applicant->department->int_college_id }}">{{ $patent->copyright->applicant->department->college->str_college_name }} ({{ $patent->copyright->applicant->department->college->char_college_code }})</a></p>
          <p class="text-muted">Branch: <a href="/admin/maintenance/branch/{{ $patent->copyright->applicant->department->college->int_branch_id }}">{{ $patent->copyright->applicant->department->college->branch->str_branch_name }}</a> - {{ $patent->copyright->applicant->department->college->branch->str_branch_address }}</p>
         <br>
            <label class="text-muted">Work Co-Authors: </label>
            @forelse($patent->copyright->applicant->coAuthors as $coAuthor)
              <h6 class="text-muted">{{ $coAuthor->str_first_name }} {{ $coAuthor->str_middle_name }} {{ $coAuthor->str_last_name }}</h6>
            @empty
              <h6 class="text-muted">There is no other authors</h6>
            @endforelse
        </div>
      </div>      
      <div class="card-footer text-muted">
        <h6 class="text-muted">Copyright and patent application receipt and project co-authors</h6>
      </div>
    </div>
    </div>
  </div>
</div>

<!-- Message modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Message applicant</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => 'TransactionController@messageApplicant', 'method' => 'POST']) !!}
        <div class="form-group">
          {{ Form::text('numPatentId', $patent->int_id, ['class' => 'form-control', 'readonly', 'hidden']) }}
          {{ Form::text('txtFirstName', $patent->copyright->applicant->str_first_name, ['class' => 'form-control', 'readonly', 'hidden']) }}
          {{Form::label('lblEmail', 'To: '.$patent->copyright->applicant->str_first_name.' '.$patent->copyright->applicant->str_last_name.' @', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtEmail', $patent->copyright->applicant->str_email_address, ['class' => 'form-control', 'readonly'])}}
        </div>
        <div class="form-group">
          {{ Form::label('lblMessage', 'Message', ['style' => 'font-weight: bold']) }}
          {{ Form::textarea('txtAreaMessage', '', ['id' => 'container-form-control article-ckeditor', 'class' => 'form-control', 'placeholder' => "Enter message", 'rows' => '4']) }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i> Send</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div> <!-- /Message modal -->


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

        <div class="col-md-4 col-sm-4">
          <label><strong>Set schedule</strong></label><br>
          <input type="date" name="dateSchedule">
          <input type="time" name="timeSchedule">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</button>
          {{ Form::hidden('_method', 'PUT') }}
          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-thumbs-up"></i> Approve</button>
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
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-records').addClass('is-expanded');
    $('a[href="/admin/records/patents"]').addClass('active');
  });
</script>
@endsection