@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-file"></i> Project Classifications</h1>
  <p>Classification of projects to be copyright and patent</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/project-types">Project Classifications</a></li>
@endsection
@section('content')
<!-- Add project type modal -->
<div class="modal fade" id="modalProjectType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Project Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => 'Maintenance\ProjectTypeController@addProjectType', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
          <div class="form-group">
            {{Form::label('lblProjectType', 'Type of project', ['style' => 'font-weight: bold'])}} 
            {{ Form::text('txtProjectType', '', ['class' => 'form-control', 'placeholder' => 'Enter type of project']) }}
          </div>
          <div class="row form-group justify-content-center">
            <div class="col-md-12 col-sm-12">
              <label><strong>Intellectual Property Rights Classification:</strong></label><br/>
              <div class="animated-radio-button form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input form-control" type="radio" name="radioProjectType" value="C" required><span class="label-text">Copyright</span>
                </label>
              </div>
              <div class="animated-radio-button form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input form-control" type="radio" name="radioProjectType" value="P" required><span class="label-text">Patent</span>
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="input-file-project-type-img" class="control-label"><b>Project Type Image</b></label>
            <input type="file" name="fileProjectTypeImg" id="input-file-project-type-img" class="dropify" data-default-file="/storage/images/project_type/default_project_type_image.png" />
            <small class="form-text text-muted" id="fileHelp">Accepted file types: jpg, jpeg, png. This field is optional</small>
          </div>
          <br>
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
      <button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#modalProjectType"><i class="fa fa-plus"></i>Add Project Type</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th scope="col">Project Type ID</th>
                <th scope="col">Type</th>
                <th scope="col">IPR Classification</th>
                <th scope="col" class="text-center">Details</th>
              </tr>
            </thead>
            <tbody>
              @forelse($projectTypes as $projectType)
              <tr>
              <td scope="row">{{ $projectType->int_id }}</td>
              <td>{{ $projectType->char_project_type }}</td>
              @if ($projectType->char_classification == 'C')
              <td>Copyright</td>
              @else
              <td>Patent</td>
              @endif
              <td class="text-center"><a href="/admin/maintenance/project-type/{{ $projectType->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span>View</a></td>
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
    $('a[href="/admin/maintenance/project-types"]').addClass('active');
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