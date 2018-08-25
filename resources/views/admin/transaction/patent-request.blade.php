@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> Patent Request</h1>
  <p>Register project for patent</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/patent-request">Patent Request</a></li>
@endsection
@section('content')
{!! Form::open(['action' => 'TransactionController@storePatentRequest', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<div class="tile-body">
				<div class="form-group" style="display: none;">
					{{Form::label('lblCopyrightID', 'Copyright ID', ['style' => 'font-weight: bold;'])}}
					{{Form::number('getCopyrightId', $maxCopyrightId, ['class' => 'form-control', 'placeholder' => 'Copyright ID'])}}
				</div>
				<div class="form-group">
					<div class="row col-md-12">
					{{Form::label('lblProjectType', 'Class Designation of Copyrightable Works',['style' => 'font-weight:bold'])}}
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
							<select class="custom-select" name="slctProjects">
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
						<div class="col-md-8">
							<label><strong>Executive Summary of Applicant's work</strong></label>
							<small id="contactHelp" class="form-text text-muted">Tell us a story about your project or invention.</small>
							<textarea name="txtAreaPatentDescription" id = "article-ckeditor" class="form-control" placeholder="Project/Invention Summary"></textarea>	
						</div>
						<div class="col-md-4"><br><br>
							<div class="tile">
								<div class="tile-body">
									<label><strong>Check if you have the following requirements.</strong></label>
						            <div class="animated-checkbox">
						              <label>
						                <input type="checkbox"><span class="label-text text-info">Requirement documents for copyright registration, plus;</span>
						              </label>
						            </div>
						            <div class="animated-checkbox">
						              <label>
						                <input type="checkbox"><span class="label-text">Patent search results;</span>
						              </label>
						            </div>
						            <div class="animated-checkbox">
						              <label>
						                <input type="checkbox"><span class="label-text">Disclosure form</span>
						              </label>
						            </div>
								</div>
							</div>	
						</div>
					</div>
				</div><br/>
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<span></span>
					</div>
					<div class="col-md-4 col-sm-4">
						{{Form::submit('Submit', ['class' => 'btn btn-lg btn-primary btn-block'])}}
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
@section('pg-specific-js')
<!-- Page specific javascripts-->
<!-- Laravel ckeditor-->
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
<script>
  $(document).ready(function(){
    $('#li-transaction').addClass('is-expanded');
    $('a[href="/admin/transaction/patent-request"]').addClass('active');
  });
</script>
@endsection
@endsection