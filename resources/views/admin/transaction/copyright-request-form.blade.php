@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> Copyright Request</h1>
  <p>Register project for copyright</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/copyright-request">Copyright Request</a></li>
@endsection

@section('content')
{!! Form::open(['action' => 'TransactionController@storeCopyrightRequest', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
    		<h4>Applicant Details</h4>
			<small id="contactHelp" class="form-text text-muted">Tell us something about you.</small>
			<div class="row">
				<div class="col-md-4 col-sm-4">
		    		<label><strong>Type</strong></label>
					<select class="custom-select" name="slctApplicantType">
					  <option>Select type</option>
					  <option value="Student">Student</option>
					  <option value="Graduate student">Graduate student</option>
					  <option value="Professor">Professor</option>
					</select>
				</div>
				<div class="col-md-4 col-sm-4">
		            <label><strong>Gender</strong></label><br>
		            <div class="animated-radio-button form-check form-check-inline">
		              <label class="form-check-label">
		                <input class="form-check-input" type="radio" name="radioGender" value="M" required><span class="label-text">Male</span>
		              </label>
		            </div>
		            <div class="animated-radio-button form-check form-check-inline">
		              <label class="form-check-label">
		                <input class="form-check-input" type="radio" name="radioGender" value="F" required><span class="label-text">Female</span>
		              </label>
		            </div>
				</div>
				<div class="col-md-4 col-sm-4">
		            <label><strong>Birthdate</strong></label><br>
					<input class="form-control" type="date" placeholder="Select Date" name="birthdate">
		        </div>
			</div>
			<label><strong>Applicant Name</strong></label>
			<div class="row">
			    <div class="col">
					<div class="form-group">
						<input type="text" name="txtLastName" class="form-control" placeholder="Enter last name" />
					</div>
			    </div>
			    <div class="col">
					<div class="form-group">
						<input type="text" name="txtFirstName" class="form-control" placeholder="Enter first name"/>
					</div>
			    </div>
			    <div class="col">
					<div class="form-group">
						<input type="text" name="txtMiddleName" class="form-control" placeholder="Enter middle name"/>
					</div>
			    </div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col">
						<label><strong>Branch</strong></label>
						<select class="custom-select" name="slctBranch" id="branch">
						  <option>Select branch</option>
						  @forelse($branches as $branch)
						  <option value="{{$branch->int_id}}">{{$branch->str_branch_name}}</option>
						  @empty
						  <option>None</option>
						  @endforelse
						</select>
					</div>
					<div class="col">
						<label><strong>College</strong></label>
						<select class="custom-select" name="slctCollege" id="college">
						  <option>Select college</option>
						  @forelse($colleges as $college)
						  <option value="{{ $college->int_id }}">{{ $college->char_college_code }} - {{ $college->str_college_name }}</option>
						  @empty
						  @endforelse
						</select>
					</div>
					<div class="col">
						<label><strong>Department</strong></label>
						<select class="custom-select" name="slctDepartment" id="department">
						  <option>Select department</option>
						  @forelse($departments as $department)
						  <option value="{{ $department->int_id }}">{{ $department->char_department_code }} - {{ $department->str_department_name }}</option>
						  @empty
						  @endforelse
						</select>
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
				<h4>Contact Details</h4>
				<div class="form-group">
					<p id="contactHelp" class="form-text text-muted">We'll never share these data with anyone else.</p>
					<div class="row">
						<div class="col-md-4">
							<label><strong>E-Mail Address</strong></label>
							<input type="text" name="txtEmail" id="container-form-control" class="form-control" placeholder="Enter email address" />
							<small id="emailHelp" class="form-text text-muted">It'll be best if it is a gmail address.</small>
						</div>
						<div class="col-md-8">
							<label><strong>Home Address</strong></label>
							<input type="text" name="txtHome" id="container-form-control" class="form-control" placeholder="Enter home address" />
						</div>
					</div>
				</div>
				<div class="row">
				    <div class="col">
						<div class="form-group">
							<label><strong>Cellphone Number</strong></label>
							<input type="number" name="numCellphone" id="container-form-control" class="form-control" placeholder="Enter cellphone number / +63-9**-***-**** /" />
							<small id="cellphoneHelp" class="form-text text-muted">At least one of these contact numbers must be filled up.</small>
						</div>
				    </div>
				    <div class="col">
						<div class="form-group">
							<label><strong>Telephone number</strong></label>
							<input type="number" name="numTelephone" id="container-form-control" class="form-control" placeholder="Enter telephone number *e.g. 8-####*" />
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
						<button id="btnCoAuthor" class="btn btn-primary float-right mb-3">Add row</button>	
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
							<select class="custom-select" name="slctProjects">
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

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/bootstrap-datepicker.min.js') }}"></script>
<script>
$('#demoDate').datepicker({
	format: "dd/mm/yyyy",
	autoclose: true,
	todayHighlight: true
});
	$(document).ready(function(){
	    $('#li-transaction').addClass('is-expanded');
	    $('a[href="/admin/transaction/copyright-request"]').addClass('active');

		$('#branch').change(() => {
			let text = $('#branch').val();
			// console.log(text);

			$.ajax({
				method: 'GET',
				url: '/api/colleges',
				dataType: 'json'
			}).done((data) => {
				// console.log(data);
				$.each(data, (i, college) => {
					console.log(college[0].str_college_name);
					$('#college').append(`<option id="${int_id}">${char_college_code} - ${str_college_name}</option>`);
				})
				// $.map(data, (department, i) => {
				// 	$('select#department').append(`<option>${department.str_department_name}</option>`);
				// });
			});
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
	});
</script>
<!-- Laravel ckeditor-->
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
@endsection