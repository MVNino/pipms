@extends('admin.layouts.app')

@section('pg-title')
@forelse($applicantCollection as $applicant)
<h1><i class="fa fa-user"></i> {{ $applicant->user->str_first_name }} {{ $applicant->user->str_last_name }}</h1>
  <p>Author of a project request</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Records</li>
<li class="breadcrumb-item"><a href="/admin/records/applicants">Applicants</a></li>
<li class="breadcrumb-item"><a href="/admin/records/applicant/{{ $applicant->int_id }}">{{ $applicant->str_last_name }}</a></li>
@endsection
@section('content')
<!-- Message modal-->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="modalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="modalLongTitle">Message {{ $applicant->user->str_first_name }} {{ $applicant->user->str_last_name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => 'TransactionController@messageApplicant', 'method' => 'POST']) !!}
        <div class="form-group">
          {{Form::label('lblEmail', 'To: ', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtEmail', $applicant->user->email, ['class' => 'form-control', 'placeholder' => 'Enter email', 'required', 'readonly'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblMessage', 'Message', ['style' => 'font-weight: bold'])}}
          {{Form::textarea('txtAreaMessage', '', ['id' => 'container-form-control article-ckeditor', 'class' => 'form-control', 'placeholder' => "Enter message", 'rows' => '4'])}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i> Send</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div><!-- /Message -->
<div class="row">
  <div class="col-md-7">    
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
        <div class="row">
          <div class="col-md-10">
            <h4>Applicant details</h4>
          </div>
          <div class="col-md-2">
          </div>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">{{ $applicant->user->str_first_name }} {{ $applicant->user->str_middle_name }} {{ $applicant->user->str_last_name }}</h5>
          <h6 class="card-subtitle text-muted">A <a href="/admin/maintenance/department/{{ $applicant->int_department_id }}">{{ $applicant->department->str_department_name }}</a> {{ $applicant->char_applicant_type }}</h6>
        </div>
        <div class="card-body">
          <p><strong>College: </strong><a href="/admin/maintenance/college/{{ $applicant->department->int_college_id }}">{{ $applicant->department->college->char_college_code }} - {{ $applicant->department->college->str_college_name }}</a></p>
          <p><strong>Branch: </strong><a href="/admin/maintenance/branch/{{ $applicant->department->college->int_branch_id }}">{{ $applicant->department->college->branch->str_branch_name }}</a></p>
          <p>Home Address: <strong>{{ $applicant->str_home_address }}</strong></p>
          <p>Email Address: <strong>{{ $applicant->user->email }}</strong></p>
          <p>Cellphone Number: <strong>{{ $applicant->bigInt_cellphone_number }}</strong></p>
          <p>Telephone Number: <strong>{{ $applicant->mdmInt_telephone_number }}</strong></p>
          <p>Co-Authors:</p>
         @forelse($applicant->coAuthors as $coAuthor)
            <h6 class="text-muted">{{ $coAuthor->str_first_name }} {{ $coAuthor->str_middle_name }} {{ $coAuthor->str_last_name }}</h6>
          @empty
            <h6 class="text-muted">There is no other authors</h6>
          @endforelse
        </div>
        <div class="card-footer text-muted">
          <div class="row">
            <div class="col-md-7">
              <strong>Date joined:</strong> {{ $applicant->user->created_at }}
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-2">
              <p><button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-envelope"></i>Message</button></p>
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
          <h4>Applicant's project request/s</h4>
        </div> 
      </div>
      </div>
      <div class="card-body">
        <div class="bs-component">
          <div class="list-group">
            @foreach($applicant->copyrights as $copyright)
            <a class="list-group-item list-group-item-action" href="/admin/records/copyright/{{ $applicant->copyright }}">{{ $copyright->str_project_title }}</a>
            @endforeach
          </div>
        </div>
      </div>
      <div class="card-footer text-muted">Project requested for copyright and patent by <strong>{{ $applicant->str_first_name }} {{ $applicant->str_last_name }}</strong></p></div>
    </div>
    </div>
  </div>
  </div>
</div>

@empty
  @include('admin.includes.page-error')
@endforelse
@section('pg-specific-js')
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script>$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-records').addClass('is-expanded');
    $('a[href="/admin/records/applicants"]').addClass('active');
  });
</script>
@endsection
@endsection