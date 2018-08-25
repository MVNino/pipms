@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> Departments</h1>
  <p>Sub-unit of college</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/departments">Departments</a></li>
@endsection
@section('content')
<!-- Add department modal-->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => 'Maintenance\DepartmentController@addDepartment', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
          {{Form::label('lblDepartmentCode', 'Department Code', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtDepartmentCode', '', ['class' => 'form-control', 'placeholder' => 'Enter department code'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblDepartmentName', 'Department Name', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtDepartmentName', '', ['class' => 'form-control', 'placeholder' => 'Enter department name'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblDepartmentDescription', 'Department Description', ['style' => 'font-weight: bold'])}}
          {{Form::textarea('txtAreaDepartmentDescription', '', ['id' => 'container-form-control article-ckeditor', 'class' => 'form-control', 'placeholder' => "Enter department description *optional field*", 'rows' => '4'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblCollegeCode', 'Assign department to', ['style' => 'font-weight: bold'])}}
        <select data-placeholder="Select college" class="custom-select" name="slctCollegeId">
          <option selected>Select college</option>
          @forelse($colleges as $college)
          <option value="{{ $college->int_id }}">{{ $college->char_college_code }} - {{ $college->str_college_name }} ({{ $college->branch->str_branch_name }})</option>
          @empty
            <option>None</option>
          @endforelse
        </select>
        </div>
        <div class="form-group">
          {{ Form::label('lblDepartmentProfileImg', 'Department Profile Image', ['class' => 'control-label', 'style' => 'font-weight: bold']) }}
          {{ Form::file('fileDepartmentProfileImg', ['class' => 'form-control form-control-file']) }}
          <small class="form-text text-muted" id="fileHelp">Accepted file types: jpg, jpeg, png. This field is optional</small>
        </div>
        <div class="form-group">
          {{ Form::label('lblDepartmentBannerImg', 'Department Banner Image', ['class' => 'control-label', 'style' => 'font-weight: bold']) }}
          {{ Form::file('fileDepartmentBannerImg', ['class' => 'form-control form-control-file']) }}
          <small class="form-text text-muted" id="fileHelp">Accepted file types: jpg, jpeg, png. This field is optional</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>        
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-md-11">
        <span></span>
    </div>
    <div class="col-md-1">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus"></i>Add department
      </button>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered col-md-12" id="sampleTable">
            <thead>
              <tr>
                <th scope="col">Department ID</th>
                <th scope="col">Department Code</th>
                <th scope="col">Deparment Name</th>
                <th scope="col">College Code</th>
                <th scope="col">College Name</th>
                <th scope="col" class="text-center">Details</th>
              </tr>
            </thead>
            <tbody>
              @forelse($departments as $department)
              <tr>
              <td scope="row">{{ $department->int_id }}</td>
                <td>{{ $department->char_department_code }}</td>
              <td>{{ $department->str_department_name }}</td>
              <td>{{ $department->college->char_college_code }}</td>
              <td>{{ $department->college->str_college_name }}</td>
              <td class="text-center"><a href="/admin/maintenance/department/{{ $department->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span>View</a></td>
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
<script src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script>$('#sampleTable').DataTable();</script>
  <script src="{{ asset('vali/js/plugins/chosen.jquery.min.js') }}"></script>
  <script>
    $(document).ready(function(){
      $('#li-maintenance').addClass('is-expanded');
      $('a[href="/admin/maintenance/departments"]').addClass('active');
    });      
    jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });
  </script>
@endsection
@endsection