@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-file"></i> View Requirement</h1>
  <p>A requirement in application for copyright/patent registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/requirements">Requirements</a></li>
<li class="breadcrumb-item"><a href="/admin/maintenance/requirement/{id}">View Requirement</a></li>
@endsection
@section('content')
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Requirement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                {!! Form::open(['action' => ['Maintenance\RequirementController@updateRequirement', $requirement->int_id], 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                  {{Form::label('lblRequirement', 'Requirement', ['style' => 'font-weight: bold'])}}
                  {{Form::textarea('txtAreaRequirement', $requirement->str_requirement, ['class' => 'form-control', 'placeholder' => "Enter requirement", 'rows' => '4'])}}
                </div>
                <div class="row form-group justify-content-center">
                  <div class="col-md-12 col-sm-12">
                    <label><strong>Intellectual Property Rights Classification:</strong></label><br/>
                    <div class="animated-radio-button form-check form-check-inline">
                      <label class="form-check-label">
                        @if($requirement->char_ipr == 'C')
                        <input class="form-check-input" type="radio" name="radioProjectType" value="C" checked required><span class="label-text">Copyright</span>
                        @else
                        <input class="form-check-input" type="radio" name="radioProjectType" value="C" required><span class="label-text">Copyright</span>
                        @endif
                      </label>
                    </div>
                    <div class="animated-radio-button form-check form-check-inline">
                      <label class="form-check-label">
                        @if($requirement->char_ipr == 'P')
                        <input class="form-check-input" type="radio" name="radioProjectType" value="P" checked required>
                          <span class="label-text">Patent</span>
                        @else
                        <input class="form-check-input" type="radio" name="radioProjectType" value="P" required>
                          <span class="label-text">Patent</span>
                        @endif
                      </label>
                    </div>


                  </div>
                </div><br>
                {{ Form::hidden('_method', 'PUT') }}
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Close</button>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>  
                </div>
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div> <!-- /Edit branch modal -->

        <div class="row">
          <div class="col-md-7">    
            <div class="bs-component">
              <div class="card">
                <div class="card-header pb-0">
                <div class="row">
                  <div class="col-md-10">
                    <h4>Requirement Details</h4>
                  </div>
                  <div class="col-md-2">
                    <p><button type="button" class="btn btn-primary mb-1 float-right" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-edit"></i>Edit</button></p>
                  </div> 
                </div>
                </div>
                <div class="card-body">
                  <h5 class="card-title">{{ $requirement->str_requirement }}</h5>
                </div>
                <div class="card-body">
                @if($requirement->char_ipr == 'P')
                <p class="card-text"><strong>Intellectual Property Rights:</strong> Patent</p>
                @else
                <p class="card-text"><strong>Intellectual Property Rights:</strong> Copyright</p>
                @endif
                  @if($requirement->updated_at == $requirement->created_at)
                    <p><strong>Record last updated at: </strong>Same as the date it was added.</p>
                  @else
                  <p><strong>Record last updated at:</strong> 
                    @if($requirement->updated_at->diffInDays(Carbon\Carbon::now()) < 2)
                      {{ $requirement->updated_at->format('M d - g:i A') }}
                    @else
                      {{ $requirement->updated_at->format('M d Y - g:i A') }}
                    @endif
                  </p>
                  @endif
                </div>
                <div class="card-footer text-muted"><strong>Date added:</strong> 
                  @if($requirement->created_at->diffInDays(Carbon\Carbon::now()) < 2)
                    {{ $requirement->created_at->format('M d - g:i A') }}
                  @else
                    {{ $requirement->created_at->format('M d, Y') }}
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
                    <h4>Related Requirements</h4>
                  </div> 
                </div>
                </div>
                <div class="card-body">
                  <div class="bs-component">
                    <div class="list-group">
                    @foreach($requirements as $req)
                      @if($req->str_requirement != $requirement->str_requirement)
                        <a class="list-group-item list-group-item-action" href="/admin/maintenance/requirement/{{ $req->int_id }}">
                          <strong>{{ $req->str_requirement }}</strong>
                        </a>
                      @endif
                    @endforeach
                    </div>
                  </div>
                </div>
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
    $('a[href="/admin/maintenance/requirements"]').addClass('active');
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