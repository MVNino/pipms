@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-user-o"></i> Faculties</h1>
  <p>In charge of every department</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/faculties">Faculties</a></li>
@endsection
@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Faculty</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => 'MaintenanceController@addFaculty', 'method' => 'POST']) !!}
        <div class="form-group">
          {{Form::label('lblFirstName', 'First Name', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtFirstName', '', ['class' => 'form-control', 'placeholder' => 'Enter first name', 'required'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblMiddleName', 'Middle Name', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtMiddleName', '', ['class' => 'form-control', 'placeholder' => 'Enter middle name *optional*'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblLastName', 'Last Name', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtLastName', '', ['class' => 'form-control', 'placeholder' => 'Enter last name', 'required'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblEmail', 'Email Address', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtEmail', '', ['class' => 'form-control', 'placeholder' => 'Enter email address', 'required'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblDepartmentCode', 'Assign faculty to', ['style' => 'font-weight: bold'])}}
        <select class="custom-select" name="slctDepartmentId">
          <option selected>Select department</option>
          @forelse($departments as $department)
          <option value="{{ $department->int_id }}">{{ $department->char_department_code }} - {{ $department->char_college_code }} ({{ $department->str_branch_name }})</option>
          @empty
            <option>None</option>
          @endforelse
        </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div><!-- /Add faculty modal -->

<div class="row">
    <div class="col-md-11">
        <span></span>
    </div>
    <div class="col-md-1">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-info mb-2 float-right" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus"></i>Add faculty</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th scope="col">Faculty ID</th>
                <th scope="col">Faculty Name</th>
                <th scope="col">E-Mail Address</th>
                <th scope="col">Department - College - Branch</th>
                <th scope="col" class="text-center">Details</th>
              </tr>
            </thead>
            <tbody>
              @forelse($faculties as $faculty)
              <tr>
              <td scope="row">{{ $faculty->int_id }}</td>
              <td>{{ $faculty->str_first_name }} {{ $faculty->str_middle_name }} {{ $faculty->str_last_name }}</td>
              <td>{{ $faculty->str_email_address }}</td>
              <td>{{ $faculty->char_department_code }} - {{ $faculty->char_college_code }} - {{ $faculty->str_branch_name }}</td>
              <td class="text-center"><a href="/admin/maintenance/faculty/{{ $faculty->int_id }}" role="button" class="btn btn-primary"><span class="fa fa-eye"></span>View</a></td>
              </tr>
              @empty  
                <div class="alert alert-warning">
                  There is no record yet.
                </div>
              @endforelse
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

@section('pg-specific-js')
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-maintenance').addClass('is-expanded');
    $('a[href="/admin/maintenance/faculties"]').addClass('active');
  });
</script>
@endsection
@endsection