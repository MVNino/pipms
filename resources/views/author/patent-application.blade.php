@extends('author.layouts.app')

@section('pg-title')
<h1><i class="fa fa-certificate"></i> Patent Registration</h1>
	<p>Apply project for patent registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item"><a href="/author/apply-patent-project">Patent Application</a></li>
@endsection
@section('content')

<div class="container">	
{!! Form::open(['action' => 'Transaction\PendRequestController@storePatentRequest', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<div class="tile-body">
				<div class="form-group" style="display: none;">
					{{Form::label('lblCopyrightID', 'Copyright ID', ['style' => 'font-weight: bold;'])}}
					{{Form::number('getCopyrightId', $maxCopyrightId, ['class' => 'form-control', 'placeholder' => 'Copyright ID'])}}
				</div>
				<div class="form-group">
					<h3 class="text-muted text-center">Patent Application Form</h3>
					<div class="row col-md-12">
					{{Form::label('lblProjectType', 'Class Designation of Copyrightable/Patentable Works',['style' => 'font-weight:bold'])}}
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
					<div class="row">
						<div class="col-md-4">
							<label><strong>Project Compliance</strong></label>
							<select class="custom-select" name="slctProject">
							  <option>Select project</option>
							@forelse($projects as $project)
								<option value="{{ $project->int_id }}">{{ $project->str_project_name }}</option>
							@empty
							@endforelse
							</select>
						</div>
						<div class="col-md-8">
						{{Form::label('title', 'Title of work', ['style' => 'font-weight:bold;'])}}
						{{Form::text('txtPatentTitle', '', ['class' => 'form-control', 'placeholder' => 'Enter title of work'])}}
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12">
							<label><strong>Executive Summary of Applicant's work</strong></label>
							<small id="contactHelp" class="form-text text-muted">Tell us a story about your project or invention.</small>
							<textarea name="txtAreaPatentDescription" id = "article-ckeditor" class="form-control" placeholder="Project/Invention Summary"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="tile">
								<div class="tile-body">
									<label><strong><span class="text-warning">Note:</span> You must have the following requirements for your project's patent registration</strong></label>
									<ul class="list-group list-group-flush">
									  <li class="list-group-item text-muted"><span class="label-text text-info">Requirement documents for copyright registration, plus;</span></li>
									  <li class="list-group-item text-muted">Patent search results</li>
									  <li class="list-group-item text-muted">Disclosure form</li>				
									</ul>
						            <small id="requirementHelp" class="form-text text-muted">Note: You must bring these things for your actual copyright application in the office.</small>
								</div>
							</div>
						</div>	
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<span></span>
					</div>
					<div class="col-md-4 col-sm-4">
						<button type="submit" class="btn btn-md btn-primary btn-block" style="font-size: 1.25em"><i class="fa fa-envelope" style="font-size: 20px;"></i>Submit</button>
					</div>
					<div class="col-md-4 col-sm-4">
						<span></span>
					</div>
				</div>
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
	$('a[href="/author/apply-patent-project"]').addClass('active');
});
</script>
@endsection