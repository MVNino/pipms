@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-file"></i> {{ $project->str_project_name }}</h1>
  <p>Possible project to be copyright and patent</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/projects">Projects</a></li>
<li class="breadcrumb-item"><a href="/admin/maintenance/projects/{{ $project->int_id }}">{{ $project->str_project_name }}</a></li>
@endsection
@section('content')
<!-- Edit project modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => ['Maintenance\ProjectController@updateProject', $project->int_id, $project->int_department_id], 'method' => 'POST']) !!}
        <div class="form-group">
          {{Form::label('lblProjectName', 'Project Name', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtProjectName', $project->str_project_name, ['class' => 'form-control', 'placeholder' => 'Enter project name', 'required'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblProjectDescription', 'Project Description', ['style' => 'font-weight: bold'])}}
          {{Form::textarea('txtAreaProjectDescription', $project->mdmTxt_project_description, ['id' => 'container-form-control article-ckeditor', 'class' => 'form-control', 'placeholder' => "Enter project description *optional field*", 'rows' => '4'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblProjectType', 'Classified as', ['style' => 'font-weight: bold'])}}
        <select data-placeholder="Select project type" class="custom-select" name="slctProjectTypeId">
          <option value="{{ $project->projectType->int_id }}" selected>{{ $project->projectType->char_project_type }} -
           @if($project->projectType->char_classification == 'C')
                Copyright
              @else
                Patent
              @endif</option>
          @forelse($projectTypes as $projectType)
            @if($projectType->char_project_type != $project->projectType->char_project_type)
            <option value="{{ $projectType->int_id }}">{{ $projectType->char_project_type }} - 
              @if($projectType->char_classification == 'C')
                Copyright
              @else
                Patent
              @endif</option>              
            @endif
          @empty
            <option>None</option>
          @endforelse
        </select>
        </div>
        <div class="form-group">
          {{Form::label('lblDepartmentCode', 'Assign project to', ['style' => 'font-weight: bold'])}}
        <select data-placeholder="Select department" class="custom-select" name="slctDepartmentId">
          <option value="{{ $project->int_department_id }}" selected>{{ $project->department->char_department_code }} - {{ $project->department->str_department_name }} of ({{ $project->department->college->char_college_code }} - {{ $project->department->college->branch->str_branch_name }})</option>
          @forelse($departments as $department)
            @if($project->int_department_id != $department->int_id)
            <option value="{{ $department->int_id }}">{{ $department->char_department_code }} - {{ $department->str_department_name }} of ({{ $department->college->char_college_code }} - {{ $department->college->branch->str_branch_name }})</option>
            @endif
          @empty
            <option>None</option>
          @endforelse
        </select>
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
</div> <!-- /Edit project modal -->

<div class="row">
  <div class="col-md-7">    
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
        <div class="row">
          <div class="col-md-10">
            <h4>Project details</h4>
          </div>
          <div class="col-md-2">
            <p><button type="button" class="btn btn-primary mb-1 float-right" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-edit"></i>Edit</button></p>
          </div>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">{{ $project->str_project_name }}</h5>
          <h6 class="card-subtitle text-muted"><a href="/admin/maintenance/department/{{ $project->int_department_id }}">{{ $project->department->str_department_name }}</a></h6>
        </div>
        <div class="card-body">
          <p class="card-text"><strong>Project Classification:</strong> {{ $project->projectType->char_project_type }}</p>
          @if ($project->char_classification == 'C')
          <p class="card-text"><strong>Intellectual Property Rights Classification:</strong> Copyright</p>
          @else
          <p class="card-text"><strong>Intellectual Property Rights Classification:</strong> Patent</p>
          @endif
          <p class="card-text"><strong>Description:</strong> {{ $project->mdmTxt_project_description }}</p>
          <p class="card-text"><strong>Year: {{ $project->int_year_level }}</strong> </p>
          <p class="card-text"><strong>Semester: {{ $project->char_semester }}</strong> </p>
          <p><strong>College: </strong><a href="/admin/maintenance/college/{{ $project->department->int_college_id }}">{{ $project->department->college->char_college_code }} - {{ $project->department->college->str_college_name }}</a></p>
          <p><strong>Branch: </strong><a href="/admin/maintenance/branch/{{ $project->department->college->int_branch_id }}">{{ $project->department->college->branch->str_branch_name }}</a></p>
          @if($project->updated_at == $project->created_at)
          <p><strong>Last updated: </strong>Same as the date it was created</p>
          @else
          <p><strong>Last updated:</strong>  
            @if($project->updated_at->diffInDays(Carbon\Carbon::now()) < 2)
              {{ $project->updated_at->format('M d - g:i A') }}
            @else
              {{ $project->updated_at->format('M d Y - g:i A') }}
            @endif
          </p>
          @endif
        </div>
        <div class="card-footer text-muted"><strong>Date added:</strong>  
          @if($project->created_at->diffInDays(Carbon\Carbon::now()) < 2)
            {{ $project->created_at->format('M d - g:i A') }}
          @else
            {{ $project->created_at->format('M d Y - g:i A') }}
          @endif
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
            <h4>Related projects</h4>
          </div> 
        </div>
        </div>
        <div class="card-body">
        <div class="bs-component">
          <div class="list-group">
            @forelse($otherProjects as $otherProject)
            <a class="list-group-item list-group-item-action" href="/admin/maintenance/project/{{ $otherProject->int_id }}/{{ $otherProject->int_department_id }}">{{ $otherProject->str_project_name }}</a>
            @empty
              <a class="list-group-item list-group-item-action disabled" href="#">There is no other project under the same department.</a>
            @endforelse
        </div>
        </div>
        </div>
        <div class="card-footer text-muted"><p class="text text-info">List of other projects under <strong><a href="/admin/maintenance/department/{{ $project->int_department_id }}">same</a></strong> department</p></div>
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
    $('a[href="/admin/maintenance/projects"]').addClass('active');
  });
</script>
@endsection
@endsection