@extends('guest.layouts.app')

@section('pg-specific-css')
<!-- Elite Dropify CSS-->
<link rel="stylesheet" href="{{ asset('elite/css/dropify.min.css') }}">
@endsection

@section('content')
<section class="material-half-bg">
  <div class="cover"></div>
</section>
<section class="login-content">
<div class="container">
{!! Form::open(['action' => 'Transaction\RegisterAuthorController@requestAuthorAccount', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'formId']) !!}
@csrf
<div class="tile">
    <div class="tile-body">
		<div class="row">
		    <div class="col-md-8">
	    		<h4>Applicant Details</h4>
				<small id="contactHelp" class="form-text text-muted">Tell us something about you.</small>
				<div class="row">
					<div class="col-md-4 col-sm-4">
			    		<label><strong>Type of Applicant</strong></label>
						<select class="custom-select" name="slctApplicantType" required>
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
					<div class="form-group col-md-4 col-sm-4">
			            <label><strong>Birthdate</strong></label><br>
						<input class="form-control" type="date" placeholder="Select Date" name="birthdate" required>
			        </div>
				</div>
				<label><strong>Applicant's Name</strong></label>
				<div class="row">
				    <div class="col">
						<div class="form-group">
							<input type="text" name="txtLastName" class="form-control" placeholder="Lastname" required/>
						</div>
				    </div>
				    <div class="col">
						<div class="form-group">
							<input type="text" name="txtFirstName" class="form-control" placeholder="Firstname" required/>
						</div>
				    </div>
				    <div class="col">
						<div class="form-group">
							<input type="text" name="txtMiddleName" class="form-control" placeholder="Middlename"/>
						</div>
				    </div>
				</div>
				<div class="form-group">
					<label><strong>E-Mail Address</strong></label>
					<input type="email" name="txtEmail" id="container-form-control" class="form-control" placeholder="Enter email address" required />
					<small id="emailHelp" class="form-text text-muted">It'll be best if it is a gmail address.</small>
				</div>
			</div>
			<div class="col-md-4">
				<h4>Applicant's Receipt</h4>
				<small id="contactHelp" class="form-text text-muted">Receipt from your copyright request fee. <br>These fields are <span class="text-info">required.</span></small>
				<div class="row">
		        	<div class="col-md-12">
		        		<div class="form-group">
			        	{{ Form::label('lblReceiptCode', 'Receipt Code', ['style' => 'font-weight: bold;']) }}
			    		{{ Form::text('txtReceiptCode', '', ['class' => 'form-control', 'placeholder' => 'Enter receipt code', 'required']) }}
						<small id="contactHelp" class="form-text text-muted">Example: ###</small>
		        		</div>
		        	</div>
	        	</div>
	        	<div class="row">
		        	<div class="col-md-12">
				         <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">File Upload1</h4>
                                <label for="input-file-max-fs">You can add a max file size</label>
                                <input type="file" id="input-file-max-fs" class="dropify" data-max-file-size="2M" />


                            </div>
                        </div>

		        	</div>
	        	</div>
			</div>
		</div>

		<div class="row ">
			<div class="col-md-9"></div>
			<div class="col-md-3">
				@captcha()
				<button type="submit" class="btn btn-md btn-primary btn-block">Submit</button>
			</div>
		</div>
	</div>
 </div>
{!! Form::close() !!}
</div>
</section> 
@endsection

@section('pg-specific-js')

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