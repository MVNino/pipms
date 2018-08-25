@include('admin.includes.head-content')
@include('admin.includes.navbar-guest')

<br><br><br>
@include('includes.messages');
<div class="container">
<h3>Good day {{ $copyright->applicant->str_first_name }}! Kindly revise your application form for your project's copyright registration.</h3>
{!! Form::open(['action' => ['TransactionController@reviseCopyrightForm', $copyright->int_id, $copyright->str_revision_token], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
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
						<!-- kulang pa -->
					  <option value="{{ $copyright->applicant->char_applicant_type }}">{{ $copyright->applicant->char_applicant_type }}</option>
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
					<input class="form-control" id="demoDate" type="text" placeholder="Select Date">
		        </div>
			</div>
			<label><strong>Applicant Name</strong></label>
			<div class="row">
			    <div class="col">
					<div class="form-group">
						<input type="text" name="txtLastName" class="form-control" placeholder="Enter last name" value="{{ $copyright->applicant->str_last_name }}"/>
					</div>
			    </div>
			    <div class="col">
					<div class="form-group">
						<input type="text" name="txtFirstName" class="form-control" placeholder="Enter first name" value="{{ $copyright->applicant->str_first_name }}"/>
					</div>
			    </div>
			    <div class="col">
					<div class="form-group">
						<input type="text" name="txtMiddleName" class="form-control" placeholder="Enter middle name"value="{{ $copyright->applicant->str_middle_name }}" />
					</div>
			    </div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col">
						<label><strong>Branch</strong></label>
						<select class="custom-select" name="slctBranch" id="branch">
						  <option value="{{ $copyright->applicant->department->college->int_branch_id }}" selected>{{ $copyright->applicant->department->college->branch->str_branch_name }}</option>
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
						  <option value="{{ $copyright->applicant->department->int_college_id }}" selected>{{ $copyright->applicant->department->college->char_college_code }}</option>
						  @forelse($colleges as $college)
						  <option value="{{ $college->int_id }}">{{ $college->char_college_code }} - {{ $college->str_college_name }}</option>
						  @empty
						  @endforelse
						</select>
					</div>
					<div class="col">
						<label><strong>Department</strong></label>
						<select class="custom-select" name="slctDepartment" id="department">
						  <option value="{{ $copyright->applicant->department->int_id }}">{{ $copyright->applicant->department->char_department_code }}</option>
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
							<input type="text" name="txtEmail" id="container-form-control" class="form-control" placeholder="Enter email address" value="{{ $copyright->applicant->str_email_address }}" />
							<small id="emailHelp" class="form-text text-muted">It'll be best if it is a gmail address.</small>
						</div>
						<div class="col-md-8">
							<label><strong>Home Address</strong></label>
							<input type="text" name="txtHome" id="container-form-control" class="form-control" value="{{ $copyright->applicant->str_home_address }}" placeholder="Enter home address" />
						</div>
					</div>
				</div>
				<div class="row">
				    <div class="col">
						<div class="form-group">
							<label><strong>Cellphone Number</strong></label>
							<input type="number" name="numCellphone" id="container-form-control" class="form-control" placeholder="Enter cellphone number / +63-9**-***-**** /" value="{{ $copyright->applicant->bigInt_cellphone_number }}" />
							<small id="cellphoneHelp" class="form-text text-muted">At least one of these contact numbers must be filled up.</small>
						</div>
				    </div>
				    <div class="col">
						<div class="form-group">
							<label><strong>Telephone number</strong></label>
							<input type="number" name="numTelephone" id="container-form-control" class="form-control" placeholder="Enter telephone number *e.g. 8-####*" value="{{ $copyright->applicant->mdmInt_telephone_number }}" />
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
				@for($i = 0; $i < 3; $i++)
				<label><strong>Name</strong></label>
				<div class="row" id="row-co-author">
				    <div class="col-md-3">
						<div class="form-group">
							<input type="text" name="txtCALastName" class="form-control" placeholder="Enter last name" />
						</div>
				    </div>
				    <div class="col-md-3">
						<div class="form-group">
							<input type="text" name="txtCAFirstName" class="form-control" placeholder="Enter first name"/>
						</div>
				    </div>
				    <div class="col-md-3">
						<div class="form-group">
							<input type="text" name="txtCAMiddleName" class="form-control" placeholder="Enter middle name"/>
						</div>
				    </div>
					<div class="col-md-3 col-sm-3">
			            <label><strong>Gender</strong></label>&nbsp&nbsp&nbsp
			            <div class="form-check form-check-inline animated-radio-button">
						  <label class="form-check-label">
			                <input class="form-check-input" type="radio" name="coAuthorGender"><span class="label-text">Male</span>
			              </label>
						</div>
						<div class="form-check form-check-inline animated-radio-button">
							<label class="form-check-label">
			                <input class="form-check-input" type="radio" name="coAuthorGender"><span class="label-text">Female</span>
			              	</label>
						</div>
					</div>
				</div>
				@endfor
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
		    		{{ Form::text('txtReceiptCode', $copyright->applicant->receipt->char_receipt_code, ['class' => 'form-control', 'placeholder' => 'Enter receipt code']) }}
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
						  <option value="{{ $copyright->projectType->int_id }}" selected>{{ $copyright->projectType->char_project_type }}</option>
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
							<input type="text" id="container-form-control" name="txtProjectTitle" class="form-control" placeholder="Enter title" value="{{ $copyright->str_project_title }}" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-8">
						<label><strong>Executive Summary</strong></label>
						<small id="contactHelp" class="form-text text-muted">Tell us a story about your research or project.</small>
						<textarea name="txtAreaDescription" id = "article-ckeditor" class="form-control" placeholder="Project/Research Description">{{ $copyright->mdmTxt_project_description }}</textarea>	
						</div>
						<div class="col-md-4"><br><br>
							<div class="tile">
								<div class="tile-body">
									<label><strong>Check if you have the following requirements</strong></label>
						            <div class="animated-checkbox">
						              <label>
						                <input type="checkbox"><span class="label-text">Triplicate copies of the notarized Application Form</span>
						              </label>
						            </div>
						            <div class="animated-checkbox">
						              <label>
						                <input type="checkbox"><span class="label-text">Triplicate copies of the Affidavit of Copyright Co-ownership</span>
						              </label>
						            </div>
						            <div class="animated-checkbox">
						              <label>
						                <input type="checkbox"><span class="label-text">Duplicate copies of the document/s (hardbound or softcopy) as deposit to the National Library of the Philippines</span>
						              </label>
						            </div>
						            <div class="animated-checkbox">
						              <label>
						                <input type="checkbox"><span class="label-text">Official receipt of filing fee from PUP</span>
						              </label>
						            </div>
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
	{{ Form::hidden('_method', 'PUT') }}
	@csrf
{!! Form::close() !!}
<a href="/copyright/{{ $copyright->int_id }}/revise" class="btn btn-primary">Revise!</a>
</div>
