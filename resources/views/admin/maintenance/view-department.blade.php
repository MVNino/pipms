@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> {{ $department->str_department_name }}</h1>
  <p>Sub-unit of college</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/departments">Departments</a></li>
<li class="breadcrumb-item"><a href="/admin/maintenance/department/{{ $department->int_id }}">{{ $department->char_department_code }}</a></li>
@endsection
@section('content')
<!-- Edit department modal-->
<div class="modal fade" id="modalLong" tabindex="-1" role="dialog" aria-labelledby="modalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="modalLongTitle">Edit Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => ['Maintenance\DepartmentController@updateDepartment', $department->int_id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
          {{Form::label('lblDepartmentCode', 'Department Code', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtDepartmentCode', $department->char_department_code, ['class' => 'form-control', 'placeholder' => 'Enter department code'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblDepartmentName', 'Department Name', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtDepartmentName', $department->str_department_name, ['class' => 'form-control', 'placeholder' => 'Enter department name'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblDepartmentDescription', 'Department Description', ['style' => 'font-weight: bold'])}}
          {{Form::textarea('txtAreaDepartmentDescription', $department->mdmTxt_department_description, ['id' => 'container-form-control article-ckeditor', 'class' => 'form-control', 'placeholder' => "Enter department description *optional field*", 'rows' => '4'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblCollegeCode', 'Assign department to', ['style' => 'font-weight: bold'])}}
        <select data-placeholder="Select college" class="custom-select" name="slctCollegeId">
          <option value="{{ $department->int_college_id }}" selected>{{ $department->college->char_college_code }} - {{ $department->college->str_college_name }}</option>
          @forelse($colleges as $college)
            @if($college->int_id != $department->int_college_id)
            <option value="{{ $college->int_id }}" selected>{{ $college->char_college_code }} - {{ $college->str_college_name }}</option>
            @endif
          @empty
            <option>None</option>
          @endforelse
        </select>
        </div>
        <div class="form-group">
          <label for="input-file-department-profile-img" class="control-label"><b>Department Profile Image</b></label>
          <input type="file" name="fileDepartmentProfileImg" id="input-file-department-profile-img" class="dropify" data-default-file="/storage/images/department/profile/{{ $department->str_department_profile_image }}" />
          <small class="form-text text-muted" id="fileHelp">Accepted file types: jpg, jpeg, png. This field is optional</small>
        </div>
        <div class="form-group">
          <label for="input-file-department-banner-img" class="control-label"><b>Department Banner Image</b></label>
          <input type="file" name="fileDepartmentBannerImg" id="input-file-department-banner-img" class="dropify" data-default-file="/storage/images/department/banner/{{ $department->str_department_banner_image }}" />
          <small class="form-text text-muted" id="fileHelp">Accepted file types: jpg, jpeg, png. This field is optional</small>
        </div>
        <div class="modal-footer">
          {{Form::hidden('_method', 'PUT')}}
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>        
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div><!-- /Edit department modal -->

<div class="row">
  <div class="col-md-7">    
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
        <div class="row">
          <div class="col-md-10">
            <h4>Department Details</h4>
          </div>
          <div class="col-md-2">
            <button type="button" class="btn btn-primary mb-1 float-right" data-toggle="modal" data-target="#modalLong">
              <i class="fa fa-edit"></i>Edit
            </button>
          </div>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">{{ $department->char_department_code }} - {{ $department->str_department_name }}</h5>
        </div>
        <div style="position: relative;">
        <a target="_blank" href="/storage/images/department/banner/{{ $department->str_department_banner_image }}">
        <img style="height: 200px; width: 100%; display: block;" src="/storage/images/department/banner/{{ $department->str_department_banner_image }}" alt="Department banner image">
        </a>
          <a target="_blank" href="/storage/images/department/profile/{{ $department->str_department_profile_image }}" style="position: absolute; bottom: -5%; left: 38%;">
              <img class="align-self-center rounded-circle mr-3" style="width:125px; height:125px;" alt="Department profile image" src="/storage/images/department/profile/{{ $department->str_department_profile_image }}">
          </a>
        </div>
        <div class="card-body">
          <label><strong>College: </strong><a href="/admin/maintenance/college/{{ $department->int_college_id }}">{{ $department->college->str_college_name }}</a></label><br/>
          <label><strong>Branch: </strong><a href="/admin/maintenance/branch/{{ $department->college->branch->int_id }}">{{ $department->college->branch->str_branch_name }}</a></label><br/>
          <p class="card-text"><strong>Description:</strong> {{ $department->mdmTxt_department_description }}</p>
          <p><strong>Last updated:</strong> {{ $department->updated_at }}</p>
        </div>
        <div class="card-footer text-muted">
          <strong>Date added:</strong> {{ $department->created_at }}
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
            <h4>Projects</h4>
          </div> 
        </div>
        </div>
        <div class="card-body">
          <div class="bs-component">
          <div class="list-group">
            @forelse($department->projects as $project)
            <a class="list-group-item list-group-item-action" href="/admin/maintenance/project/{{ $project->int_id }}/{{ $department->int_id }}">{{ $project->str_project_name }}</a>
            @empty
            <a class="list-group-item list-group-item-action text-info disabled" href="#">There is no assigned project/s for this department yet.</a>
            @endforelse
          </div>
          </div>
        </div>
        <div class="card-footer text-muted"><p class="text text-info">List of <strong><a href="/admin/maintenance/projects">projects</a></strong> under <strong>{{ $department->char_department_code }}</strong> department</p></div>
      </div>
    </div>
  </div>
</div>
@endsection

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
  <!-- Plugins for this page -->
<!-- ============================================================== -->
<!-- jQuery file upload -->
<script src="{{ asset('elite/js/dropify.min.js') }}"></script>
<script>
$(document).ready(function() {
    // Basic
    $('.dropify').dropify();

    // Translated
    $('.dropify-fr').dropify({
        messages: {
            default: 'Glissez-déposez un fichier ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove: 'Supprimer',
            error: 'Désolé, le fichier trop volumineux'
        }
    });

    // Used events
    var drEvent = $('#input-file-events').dropify();

    drEvent.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
    });

    drEvent.on('dropify.afterClear', function(event, element) {
        alert('File deleted');
    });

    drEvent.on('dropify.errors', function(event, element) {
        console.log('Has Errors');
    });

    var drDestroy = $('#input-file-to-destroy').dropify();
    drDestroy = drDestroy.data('dropify')
    $('#toggleDropify').on('click', function(e) {
        e.preventDefault();
        if (drDestroy.isDropified()) {
            drDestroy.destroy();
        } else {
            drDestroy.init();
        }
    })
});
</script>
@endsection