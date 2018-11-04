@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> Branches</h1>
  <p>A listing of PUP branches</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/branches">Branches</a></li>
@endsection

@section('content')
<!-- Add branch modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Branch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => 'Maintenance\BranchController@addBranch', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        @csrf
        <div class="form-group">
          {{Form::label('lblBranchName', 'Branch Name', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtBranchName', '', ['class' => 'form-control', 'placeholder' => 'Enter branch name', 'required'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblBranchAddress', 'Branch Address', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtBranchAddress', '', ['class' => 'form-control', 'placeholder' => 'Enter branch address', 'required'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblBranchDescription', 'Branch Description', ['style' => 'font-weight: bold'])}}
          {{Form::textarea('txtAreaBranchDescription', '', ['id' => 'container-form-control article-ckeditor', 'class' => 'form-control', 'placeholder' => "Enter branch description *optional field*", 'rows' => '4'])}}
        </div>
        <div class="form-group">
          <label for="input-file-branch-profile-img" class="control-label"><b>Branch Profile Image</b></label>
          <input type="file" name="fileBranchProfileImg" id="input-file-branch-profile-img" class="dropify" data-default-file="/storage/images/branch/profile/default_branch_profile_image.png" />
          <small class="form-text text-muted" id="fileHelp">Accepted file types: jpg, jpeg, png. This field is optional</small>
        </div>
        <div class="form-group">
          <label for="input-file-branch-banner-img" class="control-label"><b>Branch Profile Image</b></label>
          <input type="file" name="fileBranchBannerImg" id="input-file-branch-banner-img" class="dropify" data-default-file="/storage/images/branch/banner/default_branch_banner_image.png" />
          <small class="form-text text-muted" id="fileHelp">Accepted file types: jpg, jpeg, png. This field is optional</small>
        </div>
        <div class="form-group">
          {{Form::label('lblBranchContactLink', 'Branch Contact Link', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtBranchContactLink', '', ['class' => 'form-control', 'placeholder' => 'Enter branch contact link *optional field*'])}}
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
<!-- /Add branch modal -->

<div class="row">
    <div class="col-md-11">
        <span></span>
    </div>
    <div class="col-md-1">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus"></i>Add branch</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th scope="col">Branch ID</th>
                <th scope="col">Branch Name</th>
                <th scope="col">Branch Address</th>
                <th scope="col" class="text-center">Details</th>
              </tr>
            </thead>
            <tbody>
              @forelse($branches as $branch)
              <tr>
              <td scope="row">{{ $branch->int_id }}</td>
              <td>{{ $branch->str_branch_name }}</td>
              <td>{{ $branch->str_branch_address }}</td>
              <td class="text-center"><a href="/admin/maintenance/branch/{{ $branch->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span>View</a></td>
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
    $('a[href="/admin/maintenance/branches"]').addClass('active');
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