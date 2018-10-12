@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-file"></i> Projects</h1>
  <p>Possible projects to be copyright and patent</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/projects">Projects</a></li>
@endsection
@section('content')
<!-- Add project modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => 'Maintenance\ProjectController@addProject', 'method' => 'POST']) !!}
        <div class="form-group">
          {{Form::label('lblProjectName', 'Project Name', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtProjectName', '', ['class' => 'form-control', 'placeholder' => 'Enter project name', 'required'])}}
        </div>
        <div class="form-group">   
          <div class="row">
            <div class="col">
              {{Form::label('lblYear', 'Year Level', ['style' => 'font-weight: bold'])}}
              <select data-placeholder="Select project type" class="custom-select" name="slctYearLevelId">
                <option selected>Select its year level</option>
                <option value="1st">First Year</option>
                <option value="2nd">Second Year</option>
                <option value="3rd">Third Year</option>
                <option value="4th">Fourth Year</option>
                <option value="5th">Fifth Year</option>
              </select>
            </div>
            <div class="col">
              {{Form::label('lblSemester', 'Semester', ['style' => 'font-weight: bold'])}}
              <select data-placeholder="Select project type" class="custom-select" name="slctSemesterId">
                <option selected>Select which semester it is taken</option>
                <option value="1st">First Semester</option>
                <option value="2nd">Second Semester</option>
                <option value="3rd">Third Semester</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          {{Form::label('lblProjectDescription', 'Project Description', ['style' => 'font-weight: bold'])}}
          {{Form::textarea('txtAreaProjectDescription', '', ['id' => 'container-form-control article-ckeditor', 'class' => 'form-control', 'placeholder' => "Enter project description *optional field*", 'rows' => '4'])}}
        </div>
        </div>
        <div class="form-group">
          {{Form::label('lblProjectType', 'Classified as', ['style' => 'font-weight: bold'])}}
        <select data-placeholder="Select project type" class="custom-select" name="slctProjectTypeId">
          <option selected>Select project classification</option>
          @forelse($projectTypes as $projectType)
          <option value="{{ $projectType->int_id }}">{{ $projectType->char_project_type }} - 
            @if($projectType->char_classification == 'C')
              Copyright
            @else
              Patent
            @endif</option>
          @empty
            <option>None</option>
          @endforelse
        </select>
        </div>
        <div class="form-group">
          {{Form::label('lblDepartmentCode', 'Assign project to', ['style' => 'font-weight: bold'])}}
        <select data-placeholder="Select department" class="custom-select" name="slctDepartmentId">
          <option selected>Select department</option>
          @forelse($departments as $department)
          <option value="{{ $department->int_id }}">{{ $department->char_department_code }} - {{ $department->str_department_name }} of ({{ $department->college->char_college_code }} - {{ $department->college->branch->str_branch_name }})</option>
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
</div> <!-- /Add project modal -->

<div class="row">
    <div class="col-md-10">
        <span></span>
    </div>
    <div class="col-md-2">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus"></i>Add Project</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th scope="col">Project ID</th>
                <th scope="col">Name</th>
                <th scope="col">Type</th>
                <th scope="col">Classification</th>
                <th scope="col">Department</th>
                <th scope="col" class="text-center">Details</th>
              </tr>
            </thead>
            <tbody>
              @forelse($projects as $project)
              <tr>
              <td scope="row">{{ $project->int_id }}</td>
              <td>{{ $project->str_project_name }}</td>
              <td>{{ $project->projectType->char_project_type }}</td>
              @if ($project->projectType->char_classification == 'C')
              <td>Copyright</td>
              @else
              <td>Patent</td>
              @endif
              <td>{{ $project->department->char_department_code }}</td>
              <td class="text-center"><a href="/admin/maintenance/project/{{ $project->int_id }}/{{ $project->department->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span>View</a></td>
              </tr>
              @empty	
              	<div class="alert alert-warning">
					There is no record yet.
				</div>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection

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