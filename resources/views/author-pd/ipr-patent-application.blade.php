@extends('author-pd.layouts.app')

@section('pg-title')
<h1><i class="fa fa-certificate"></i> Patent Registration</h1>
	<p>Apply project for patent registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item"><a href="/author/apply-patent-project">Patent Application</a></li>
@endsection
@section('content')
<div class="container">	
{!! Form::open(['action' => 'Author\IPRApplicationController@storePatentRequest', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'onsubmit' => "return confirm('Submit application form for patent registration?')"]) !!}
@csrf
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<div class="tile-body">
				<div class="form-group" style="display: none;">
					{{Form::label('lblCopyrightID', 'Copyright ID', ['style' => 'font-weight: bold;'])}}
					{{Form::number('getCopyrightId', $copyrightId, ['class' => 'form-control', 'placeholder' => 'Copyright ID'])}}
				</div>
				<div class="card">
					<div class="card-header">
					<h3 class="text-muted text-danger text-center">Patent Application Form</h3>						
					</div>
					<div class="card-body">	
						<div class="form-group">
							<div class="row col-md-12">
							{{Form::label('lblProjectType', 'Class Designation of Patentable Works',['style' => 'font-weight:bold'])}}
								<select class="custom-select" name="slctProjectType">
								  <option>Select class designation</option>
								  @forelse($projectTypes as $projectType)
								  	@if($projectType->char_classification == 'P')
								  <option value="{{ $projectType->int_id }}">{{ $projectType->char_project_type }}</option>
								  	@endif
								  @empty
								  @endforelse
								</select>
							</div>
							<div class="row col-md-12">
								<label><strong>Project Compliance</strong></label>
								<select class="custom-select" name="slctProject">
								  <option>Select project</option>
								@forelse($projects as $project)
									<option value="{{ $project->int_id }}">{{ $project->str_project_name }}</option>
								@empty
								@endforelse
								</select>
							</div>
							<div class="row col-md-12">
								{{Form::label('title', 'Title of work', ['style' => 'font-weight:bold;'])}}
								{{Form::text('str_patent_project_title', '', ['class' => 'form-control', 'placeholder' => 'Enter title of your work'])}}
							</div>
						</div>
					</div>
				</div>			
				<div class="card">
					<div class="card-header">
						<h4>Abstract of the Disclosure</h4>
					</div>
					<div class="card-body">
						<div class="form-group">
							<div class="nav-tabs-navigation">
								<div class="nav-tabs-wrapper">
									<ul id="tabs" class="nav nav-tabs" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#home" role="tab">Write</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#profile" role="tab">File Upload</a>
										</li>
									</ul>
								</div>
							</div>
							
							<div id="my-tab-content" class="tab-content text-center">
								<div class="tab-pane active" id="home" role="tabpanel">
									<div class="row">
										<div class="col-md-12">
										<small id="contactHelp" class="form-text text-muted">Tell us a story about your research or project.</small>
										<textarea name="txtAreaPatentDescription" id = "article-ckeditor" class="form-control" placeholder="Project/Research Description"></textarea>	
										</div>
									</div>	
								</div>
								<div class="tab-pane" id="profile" role="tabpanel">
									<div class="form-group">
										<h6 class="text-muted">Abstract File Upload</h6>
										<input type="file" name="filePatentSummary" id="input-file-exec-summary" class="dropify" 
											data-default-file="/storage/summary/patent/patent_summary.png" />
										<small class="form-text text-muted" id="fileHelp">Accepted file types: pdf, docx, doc, zip, rar</small>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12"><br><br>
									<div class="tile">
										<div class="tile-body">
											<label><strong><span class="text-warning">Note:</span> You must have the following requirements for your project's patent registration</strong></label>
											<ul class="list-group list-group-flush">
									  			@foreach($requirements as $requirement)

									  			@if($requirement->char_ipr == 'P')
							  						<li class="list-group-item text-muted">{{ $requirement->str_requirement }}</li>
							  					@endif
							  					@endforeach			
											</ul>
						            		<small id="requirementHelp" class="form-text text-muted">Note: You must bring these things for your actual copyright application in the office.</small>
										</div>
									</div>	
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-5">
								<span></span>
							</div>
							<div class="col-md-4 col-sm-2">
								{{-- @captcha --}}
								<button type="submit" class="btn btn-md btn-primary btn-block" style="font-size: 1.25em">Submit</button>
							</div>
							<div class="col-md-4 col-sm-5">
								<span></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}
@endsection

@section('pg-specific-js')
<!-- Laravel ckeditor-->
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
<script>
$('#li-my-projects').addClass('active');
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
{{-- Sweet Alert --}}
<script src="{{ asset('vali/js/plugins/sweetalert.min.js') }}"></script>
<script>
$('#demoSwal').click(function(){
  swal({
    title: "Submit application form?",
    text: "An application form for patent registration.",
    type: "info",
    showCancelButton: true,
    confirmButtonText: "Yes, submit my form!",
    cancelButtonText: "Cancel",
    closeOnConfirm: false,
    closeOnCancel: false
  }, function(isConfirm) {
    if (isConfirm) {
      $('#formPatent').submit();
      swal("Submitted", 
      	"Your application form for patent registration has been submitted!", 
      	"success");
    } else {
      swal("Cancelled", "The action has been cancelled!", "error");
    }
  });
});
</script>
@endsection