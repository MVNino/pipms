@extends('author-pd.layouts.app')

@section('content')
	
{!! Form::open(['action' => 'Transaction\PendRequestController@storeCopyrightRequest', 'method' => 'POST']) !!}
@csrf
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<div class="tile-body" id="body-co-author">
				<div class="row">
					<div class="col-md-3">
						<label><strong>Project Co-Authors</strong></label>
						<small id="coAuthorHelp" class="form-text text-muted">Other contributors</small>
					</div>
					<div class="col-md-7">
						<span></span>
					</div>
					<div class="col-md-2">
						<button id="btnCoAuthor" class="btn btn-default float-right mb-3">Add row</button>	
					</div>
				</div>
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

<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
    		<h4>Applicant Receipt</h4>
    		@if(auth()->user()->applicant->receipt->count() == 0)
    		<p>Since it is your first project application for copyright registration, we can acknowledge the receipt that you've submitted during your author account registration.</p>
    		@else
			<small id="contactHelp" class="form-text text-muted">Receipt from your copyright request fee. These fields are <span class="text-info">required.</span></small>
    		<div class="row">
	        	<div class="col-md-4">
	        		<div class="form-group">
		        	{{ Form::label('lblReceiptCode', 'Receipt Code', ['style' => 'font-weight: bold;']) }}
		    		{{ Form::text('txtReceiptCode', '', ['class' => 'form-control', 'placeholder' => 'Enter receipt code']) }}
					<small id="contactHelp" class="form-text text-muted">Example: ###</small>
	        		</div>
	        	</div>
	        	<div class="col-md-8">
			        <div class="form-group">
			        	{{ Form::label('lblReceiptCode', 'Receipt', ['class' => 'control-label', 'style' => 'font-weight: bold;']) }}
			        	{{ Form::file('fileReceiptImg', ['class' => 'form-control']) }}
						<small id="contactHelp" class="form-text text-muted">Upload a photo of your transaction receipt.</small>	
			        </div>
	        	</div>
    		</div>
    		@endif
        </div>
      </div>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="tile mb-3">
			<div class="tile-body">
				<h4>Project for Copyright Registration</h4>
				<div class="form-group">
					<div class="row col-md-12">				
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
					</div>
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
				<div class="form-group">
					<div class="row">
						<div class="col-md-12">
						<label><strong>Executive Summary</strong></label>
						<small id="contactHelp" class="form-text text-muted">Tell us a story about your research or project.</small>
						<textarea name="txtAreaDescription" id = "article-ckeditor" class="form-control" placeholder="Project/Research Description"></textarea>	
						</div>
					</div>
					<div class="row">
						<div class="col-md-12"><br><br>
							<div class="tile">
								<div class="tile-body">
									<label><strong><span class="text-warning">Note:</span> You must have the following requirements for your project's copyright registration</strong></label>
									<ul class="list-group list-group-flush">
									  <li class="list-group-item text-muted">Triplicate copies of the notarized Application Form</li>
									  <li class="list-group-item text-muted">Triplicate copies of the Affidavit of Copyright Co-ownership</li>
									  <li class="list-group-item text-muted">Duplicate copies of the document/s (hardbound or softcopy) as deposit to the National Library of the Philippines</li>
									  <li class="list-group-item text-muted">Official receipt of filing fee from PUP</li>
									  <li class="list-group-item text-muted">Note: You must bring these things for your actual copyright application in the office.</li>
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
@endsection