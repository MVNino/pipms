@extends('author-pd.layouts.app')

@section('content')
<div class="container">
{!! Form::open(['action' => 'Author\IPRApplicationController@storeCopyrightRequest', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'onsubmit' => "return confirm('Submit request form?')"]) !!}
@csrf
{{-- GIVE OPTION IF REUSE CoAuthors! Fix js issue --}}
<div class="card">
	<div class="card-header">
		<h4 class="text-center text-muted text-danger"><strong>Application for Copyright Registration</strong></h4>
		<div class="row">
			<div class="col-md-3">
				<h5 class="card-title">Project Co-Authors</h5>
			</div>
			<div class="col-md-7">
				<span></span>
			</div>
			<div class="col-md-2">
				<button id="btnCoAuthor" class="btn btn-danger float-right mb-3">Add row</button>	
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<div class="tile">
					<div class="tile-body" id="body-co-author">
						<label><strong>Name</strong></label>
						<div class="row" id="row-co-author">
							<div class="col">
							<div class="form-group">
								<input type="text" name="txtCALastName" class="form-control" placeholder="Enter last name" />
							</div>
							</div>
							<div class="col">
							<div class="form-group">
								<input type="text" name="txtCAFirstName" class="form-control" placeholder="Enter first name"/>
							</div>
							</div>
							<div class="col">
							<div class="form-group">
								<input type="text" name="txtCAMiddleName" class="form-control" placeholder="Enter middle name"/>
							</div>
							</div>
						</div>
						<label><strong>Name</strong></label>
						<div class="row" id="row-co-author">
							<div class="col">
							<div class="form-group">
								<input type="text" name="txtCALastName2" class="form-control" placeholder="Enter last name" />
							</div>
							</div>
							<div class="col">
							<div class="form-group">
								<input type="text" name="txtCAFirstName2" class="form-control" placeholder="Enter first name"/>
							</div>
							</div>
							<div class="col">
							<div class="form-group">
								<input type="text" name="txtCAMiddleName2" class="form-control" placeholder="Enter middle name"/>
							</div>
							</div>
						</div>
						<label><strong>Name</strong></label>
						<div class="row" id="row-co-author">
							<div class="col">
							<div class="form-group">
								<input type="text" name="txtCALastName3" class="form-control" placeholder="Enter last name" />
							</div>
							</div>
							<div class="col">
							<div class="form-group">
								<input type="text" name="txtCAFirstName3" class="form-control" placeholder="Enter first name"/>
							</div>
							</div>
							<div class="col">
							<div class="form-group">
								<input type="text" name="txtCAMiddleName3" class="form-control" placeholder="Enter middle name"/>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- FIX receipt issue when in first application --}}
@includeWhen(Auth::user()->applicant->receipt->count() > 1, 'author-pd.includes.receipt-form')

<div class="card">
	<div class="card-header">
		<h4>Project for Copyright Registration</h4>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<div class="tile mb-3">
					<div class="tile-body">
						<div class="form-group">
							<label><strong>Class Designation of Copyrightable Works</strong></label>
							<select class="custom-select" name="slctProjectType">
								<option>Select type</option>
							@forelse($projectTypes as $projectType)
								@if($projectType->char_classification == 'C')
								<option value="{{ $projectType->int_id }}">{{ $projectType->char_project_type }}</option>
								@endif
							@empty
							@endforelse
							</select>
							<div class="clearfix">
							<div class="row">
								<div class="col-md-4">
									<label><strong>Project Compliance</strong></label>
									<select class="custom-select" name="slctProject">
										<option>Select type</option>
									@forelse($projects as $project)
										<option value="{{ $project->int_id }}">{{ $project->str_project_name }}</option>
									@empty
									@endforelse
									</select>
								</div>
								<div class="col-md-8">
									<label><strong>Project/Work Title</strong></label>
									<input type="text" id="container-form-control" name="txtProjectTitle" class="form-control" placeholder="Enter title" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card">
	<div class="card-header">
		<h4>Executive Summary</h4>
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
						<textarea name="txtAreaDescription" id = "article-ckeditor" class="form-control" placeholder="Project/Research Description"></textarea>	
						</div>
					</div>	
				</div>
				<div class="tab-pane" id="profile" role="tabpanel">
					<div class="form-group">
						<h6 class="text-muted">Executive Summary File Upload</h6>
						<input type="file" name="fileExecutiveSummary" id="input-file-exec-summary" class="dropify" 
							data-default-file="/storage/summary/copyright/exec_summary.png" />
						<small class="form-text text-muted" id="fileHelp">Accepted file types: pdf, docx, doc, zip, rar</small>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12"><br><br>
					<div class="tile">
						<div class="tile-body">
							<label><strong><span class="text-warning">Note:</span> You must have the following requirements for your project's copyright registration</strong></label>
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
				@captcha
				<button type="submit" class="btn btn-md btn-primary btn-block" style="font-size: 1.25em">Submit</button>
			</div>
			<div class="col-md-4 col-sm-5">
				<span></span>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}
</div>
@endsection

@section('pg-specific-js')
<!-- Laravel ckeditor-->
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
<script>
$(document).ready(function(){
	$('#li-apply').addClass('is-expanded');
	$('a[href="/author/apply-project"]').addClass('active');
});

$('#btnCoAuthor').on('click', (e) => {
	e.preventDefault();
	$('#body-co-author').append(`<label><strong>Name</strong></label>
		<div class="row" id="row-co-author">
		    <div class="col-md-4">
				<div class="form-group">
					<input type="text" name="txtCALastName" class="form-control" placeholder="Enter last name" />
				</div>
		    </div>
		    <div class="col-md-4">
				<div class="form-group">
					<input type="text" name="txtCAFirstName" class="form-control" placeholder="Enter first name"/>
				</div>
		    </div>
		    <div class="col-md-4">
				<div class="form-group">
					<input type="text" name="txtCAMiddleName" class="form-control" placeholder="Enter middle name"/>
				</div>
		    </div>
		</div>`);
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