@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-file"></i> {{ $projectType->char_project_type }}</h1>
  <p>Possible project to be copyright and patent</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/project-types">Projects</a></li>
<li class="breadcrumb-item"><a href="/admin/maintenance/project-type/{{ $projectType->int_id }}">{{ $projectType->char_project_type }}</a></li>
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
        {!! Form::open(['action' => ['Maintenance\ProjectTypeController@updateProjectType', $projectType->int_id], 'method' => 'POST']) !!}
          <div class="form-group">
            {{Form::label('lblProjectType', 'Type of project', ['style' => 'font-weight: bold'])}} 
            {{ Form::text('txtProjectType', $projectType->char_project_type, ['class' => 'form-control', 'placeholder' => 'Enter type of project']) }}
          </div>  
          <div class="row form-group justify-content-center">
            <div class="col-md-12 col-sm-12">
              <label><strong>Intellectual Property Rights Classification:</strong></label><br/>
              <div class="animated-radio-button form-check form-check-inline">
                <label class="form-check-label">
                  @if($projectType->char_classification == 'C')
                  <input class="form-check-input" type="radio" name="radioProjectType" value="C" checked required><span class="label-text">Copyright</span>
                  @else
                  <input class="form-check-input" type="radio" name="radioProjectType" value="C" required><span class="label-text">Copyright</span>
                  @endif
                </label>
              </div>
              <div class="animated-radio-button form-check form-check-inline">
                <label class="form-check-label">
                  @if($projectType->char_classification == 'P')
                  <input class="form-check-input" type="radio" name="radioProjectType" value="P" checked required><span class="label-text">Patent</span>
                  @else
                  <input class="form-check-input" type="radio" name="radioProjectType" value="P" required><span class="label-text">Patent</span>
                  @endif
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="input-file-project-type-img" class="control-label"><b>Project Type Image</b></label>
            <input type="file" name="fileProjectTypeImg" id="input-file-project-type-img" class="dropify" data-default-file="/storage/images/project_type/{{ $projectType->str_project_type_image }}" />
            <small class="form-text text-muted" id="fileHelp">Accepted file types: jpg, jpeg, png. This field is optional</small>
          </div>
          <br>
          <div class="modal-footer">
            {{ Form::hidden('_method', 'PUT') }}
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>  
          </div>
          @csrf
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
            <h4>Project Classification Details</h4>
          </div>
          <div class="col-md-2">
            <p><button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-edit"></i>Edit</button></p>
          </div>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">Type: {{ $projectType->char_project_type }}</h5>
        </div>
        <div class="card-body">
          @if($projectType->char_classification == 'C')
          <p class="card-text"><strong>IPR Classification:</strong> Copyright</p>
          @else
          <p class="card-text"><strong>IPR Classification:</strong> Patent</p>
          @endif
          </div>
        <div class="card-footer text-muted"></div>
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
        <div class="row">
          <div class="col-md-12">
            <h4>Related project classifications</h4>
          </div> 
        </div>
        </div>
        <div class="card-body">
        <div class="bs-component">
          <div class="list-group">
            @forelse($otherProjectTypes as $otherProjectType)
              @if($otherProjectType->char_project_type != $projectType->char_project_type && $otherProjectType->char_classification == $projectType->char_classification )
            <a class="list-group-item list-group-item-action" href="/admin/maintenance/project-type/{{ $otherProjectType->int_id }}">{{ $otherProjectType->char_project_type }}</a>
          @endif
            @empty
              <a class="list-group-item list-group-item-action disabled" href="#">There is no other project under the same department.</a>
            @endforelse
          </div>
        </div>
        </div>
        <div class="card-footer text-muted"><p class="text text-info">List of other project classification under @if($projectType->char_classification == 'C')
          <b>copyright</b>
        @else
          <b>patent</b>
        @endif
          .</p></div>
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