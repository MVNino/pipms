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
	<div class="logo">
    	<h1>Account Request</h1>
	</div>
<div class="container">
{!! Form::open(['action' => 'Transaction\RegisterAuthorController@requestAuthorAccount', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'onsubmit' => "return confirm('Submit your author account request form?')"]) !!}
@csrf
<div class="tile">
    <div class="tile-body">
		<div class="row">
		    <div class="col-md-8">
	    		<h4>Author Details</h4>
				<small id="contactHelp" class="form-text text-muted">Tell us something about you.</small>
				<div class="row">
					<div class="col-md-4 col-sm-4">
			    		<label><strong>Type of Author</strong></label>
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
				<label><strong>Name</strong></label>
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
				<small id="contactHelp" class="form-text text-muted">Receipt from your copyright request fee.</small>
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
                                <h4 class="card-title">Receipt</h4>
                                <label for="input-file-max-fs">Allowed file type: jpg, jpeg, png</label>
                                <input type="file" name="fileReceiptImg" id="input-file-max-fs" class="dropify" data-max-file-size="2M" required/>
								<small id="emailHelp" class="form-text text-muted">You are required to attach the photo of the official receipt.</small>
                            </div>
                        </div>

		        	</div>
	        	</div>
			</div>
		</div>
		<div class="row ">
			<div class="col-md-5"></div>
			<div class="col-md-2">
				@captcha()
				<button type="submit" class="btn btn-md btn-primary btn-block">
					<i class="fa fa-fw fa-lg fa-check-circle"></i>Submit
				</button>
			</div>
			<div class="col-md-5">
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
{{-- Sweet Alert --}}
<script src="{{ asset('vali/js/plugins/sweetalert.min.js') }}"></script>
<script>
$('#demoSwal').click(function(){
  swal({
    title: "Submit your author account request form?",
    text: "A request form for an author account.",
    type: "info",
    showCancelButton: true,
    confirmButtonText: "Yes, submit my form!",
    cancelButtonText: "Cancel",
    closeOnConfirm: false,
    closeOnCancel: false
  }, function(isConfirm) {
    if (isConfirm) {
      $('#formInitAuthReg').submit();
      swal("Submitted", 
      	"Your request form for an author account has been submitted!", 
      	"success");
    } else {
      swal("Cancelled", "The action has been cancelled!", "error");
    }
  });
});
</script>
@endsection