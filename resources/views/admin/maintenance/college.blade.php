@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> Colleges</h1>
  <p>Sub-unit of branch</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/colleges">Colleges</a></li>
@endsection
@section('content')
<!-- Add college modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Add College</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => 'Maintenance\CollegeController@addCollege', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
          {{Form::label('lblCollegeCode', 'College Code', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtCollegeCode', '', ['class' => 'form-control', 'placeholder' => 'Enter college code', 'required'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblCollegeName', 'College Name', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtCollegeName', '', ['class' => 'form-control', 'placeholder' => 'Enter college name', 'required'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblCollegeDescription', 'College Description', ['style' => 'font-weight: bold'])}}
          {{Form::textarea('txtAreaCollegeDescription', '', ['id' => 'container-form-control article-ckeditor', 'class' => 'form-control', 'placeholder' => "Enter college description *optional field*", 'rows' => '4'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblBranchCode', 'Assign college to', ['style' => 'font-weight: bold'])}}
        <select data-placeholder="Select branch" class="custom-select" name="slctBranchId">
          <option selected>Select branch</option>
          @forelse($branches as $branch)
          <option value="{{ $branch->int_id }}">{{ $branch->str_branch_name }}</option>
          @empty
            <option>None</option>
          @endforelse
        </select>
        </div>
        <div class="form-group">
          <label for="input-file-college-profile-img" class="control-label"><b>College Profile Image</b></label>
          <input type="file" name="fileCollegeProfileImg" id="input-file-college-profile-img" class="dropify" data-default-file="/storage/images/college/profile/default_college_profile_image.png" />
          <small class="form-text text-muted" id="fileHelp">Accepted file types: jpg, jpeg, png. This field is optional</small>
        </div>
        <div class="form-group">
          <label for="input-file-college-banner-img" class="control-label"><b>College Banner Image</b></label>
          <input type="file" name="fileCollegeBannerImg" id="input-file-college-banner-img" class="dropify" data-default-file="/storage/images/college/banner/default_college_banner_image.png" />
          <small class="form-text text-muted" id="fileHelp">Accepted file types: jpg, jpeg, png. This field is optional</small>
        </div>
        <div class="form-group">
          {{Form::label('lblCollegeContactLink', 'College Contact Link', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtCollegeContactLink', '', ['class' => 'form-control', 'placeholder' => 'Enter college contact link *optional field*'])}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>  
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div> <!-- /Add college modal -->

<div class="row">
    <div class="col-md-11">
        <span></span>
    </div>
    <div class="col-md-1">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus"></i>Add college</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th scope="col">College ID</th>
                <th scope="col">College Code</th>
                <th scope="col">College Name</th>
                <th scope="col">Branch Name</th>
                <th scope="col" class="text-center">Details</th>
              </tr>
            </thead>
            <tbody>
              @forelse($colleges as $college)
              <tr>
              <td scope="row">{{ $college->int_id }}</td>
              <td>{{ $college->char_college_code }}</td>
              <td>{{ $college->str_college_name }}</td>
              <td>{{ $college->branch->str_branch_name }}</td>
              <td class="text-center"><a href="/admin/maintenance/college/{{ $college->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span>View</a></td>
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
    $('a[href="/admin/maintenance/colleges"]').addClass('active');
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