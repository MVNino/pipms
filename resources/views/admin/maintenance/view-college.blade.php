@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> {{ $college->str_college_name }}</h1>
  <p>Sub-unit of college</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/colleges">Colleges</a></li>
<li class="breadcrumb-item"><a href="/admin/maintenance/college/{{ $college->int_id }}">{{ $college->char_college_code }}</a></li>
@endsection
@section('content')
<!-- Edit college modal-->
<div class="modal fade" id="modalLong" tabindex="-1" role="dialog" aria-labelledby="modalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="modalLongTitle">Edit College</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => ['Maintenance\CollegeController@updateCollege', $college->int_id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
          {{Form::label('lblCollegeCode', 'College Code', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtCollegeCode', $college->char_college_code, ['class' => 'form-control', 'placeholder' => 'Enter college code'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblCollegeName', 'College Name', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtCollegeName', $college->str_college_name, ['class' => 'form-control', 'placeholder' => 'Enter college name'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblCollegeDescription', 'College Description', ['style' => 'font-weight: bold'])}}
          {{Form::textarea('txtAreaCollegeDescription', $college->mdmTxt_college_description, ['id' => 'container-form-control article-ckeditor', 'class' => 'form-control', 'placeholder' => "Enter college description *optional field*", 'rows' => '4'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblBranchCode', 'Assign college to', ['style' => 'font-weight: bold'])}}
        <select data-placeholder="Select branch" class="custom-select" name="slctBranchId">
          <option value="{{ $college->int_branch_id }}" selected>{{ $college->branch->str_branch_name }}</option>
          @forelse($branches as $branch)
            @if($branch->int_id != $college->int_branch_id)
            <option value="{{ $branch->int_id }}">{{ $branch->str_branch_name }}</option>
            @endif
          @empty
            <option>None</option>
          @endforelse
        </select>
        </div>
        <div class="form-group">
          <label for="input-file-college-profile-img" class="control-label"><b>College Profile Image</b></label>
          <input type="file" name="fileCollegeProfileImg" id="input-file-college-profile-img" class="dropify" data-default-file="/storage/images/college/profile/{{ $college->str_college_profile_image }}" />
          <small class="form-text text-muted" id="fileHelp">Accepted file types: jpg, jpeg, png. This field is optional</small>
        </div>
        <div class="form-group">
          <label for="input-file-college-banner-img" class="control-label"><b>College Banner Image</b></label>
          <input type="file" name="fileCollegeBannerImg" id="input-file-college-banner-img" class="dropify" data-default-file="/storage/images/college/banner/{{ $college->str_college_banner_image }}" />
          <small class="form-text text-muted" id="fileHelp">Accepted file types: jpg, jpeg, png. This field is optional</small>
        </div>
        <div class="form-group">
          {{Form::label('lblCollegeContactLink', 'College Contact Link', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtCollegeContactLink', $college->str_college_contact_link, ['class' => 'form-control', 'placeholder' => 'Enter college contact link *optional field*'])}}
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
</div><!-- /Edit college modal -->
<div class="row">
  <div class="col-md-7">    
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
        <div class="row">
          <div class="col-md-10">
            <h4>College details</h4>
          </div>
          <div class="col-md-2">
            <p><button type="button" class="btn btn-primary mb-1 float-right" data-toggle="modal" data-target="#modalLong"><i class="fa fa-edit"></i>Edit</button></p>
          </div>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">{{ $college->char_college_code }} - {{ $college->str_college_name }}</h5>
          <h6 class="card-subtitle text-muted"><a href="/admin/maintenance/branch/{{ $college->branch->int_id }}">{{ $college->branch->str_branch_name }}</a></h6>
        </div>
        <div style="position: relative;">
        <a target="_blank" href="/storage/images/college/banner/{{ $college->str_college_banner_image }}">
        <img style="height: 200px; width: 100%; display: block;" src="/storage/images/college/banner/{{ $college->str_college_banner_image }}" alt="College banner image">
        </a>
          <a target="_blank" href="/storage/images/college/profile/{{ $college->str_college_profile_image }}" style="position: absolute; bottom: -5%; left: 38%;">
              <img class="align-self-center rounded-circle mr-3" style="width:125px; height:125px;" alt="College profile image" src="/storage/images/college/profile/{{ $college->str_college_profile_image }}">
          </a>  
        </div>
        <div class="card-body">
          <p class="card-text"><strong>Description:</strong> {{ $college->mdmTxt_college_description }}</p>
          @if($college->str_college_contact_link == '')
            <p class="card-text"><b>Contact Information @:</b> There is no contact link supplied to this college.</p>
          @else
            <p class="card-text"><strong>Contact Information @:</strong> <a href="https://www.pup.edu.ph/{{ $college->str_college_contact_link }}" class="btn btn-link">{{ $college->str_college_contact_link }}</a></p>
          @endif
          @if($college->updated_at == $college->created_at)
            <p><strong>Record last updated at: </strong>Same as the date it was added.</p>
          @else
          <p><strong>Record last updated at:</strong> {{ $college->updated_at }}</p>
          @endif
        </div>
        <div class="card-footer text-muted"><strong>Date added:</strong> {{ $college->created_at }}</div>
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="bs-component">
    <div class="card">
      <div class="card-header pb-0">
      <div class="row">
        <div class="col-md-12">
          <h4>Departments</h4>
        </div> 
      </div>
      </div>
      <div class="card-body">
        <div class="bs-component">
        <div class="list-group">
          @forelse($college->departments as $department)
          <a class="list-group-item list-group-item-action" href="/admin/maintenance/department/{{ $department->int_id }}"><strong>{{ $department->char_department_code }}</strong> - {{ $department->str_department_name }}</a>
          @empty
          <a class="list-group-item list-group-item-action disabled" href="#">There is no assigned department/s for this college yet.</a>
          @endforelse
        </div>
        </div>
      </div>
      <div class="card-footer text-muted"><p class="text text-info">List of <strong><a href="/admin/maintenance/departments">departments</a></strong> under <strong>{{ $college->char_college_code }}</strong> college</p></div>
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
      $('a[href="/admin/maintenance/colleges"]').addClass('active');
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