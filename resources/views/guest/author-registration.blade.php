<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vali/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login - {{ config('app.name', 'PIPMS') }}</title>
  </head>
  <body>
    @include('guest.includes.navbar')
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Account Request</h1>
      </div>
<div class="container">
	<div class="row justify-content-center">
{!! Form::open(['action' => 'Transaction\AuthorRegistrationController@requestAuthorAccount', 'method' => 'POST']) !!}
@csrf
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
        	<h3 class="text-muted text-center">Application Request Form</h3>
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
			<br>
			<label><strong>Applicant's Name</strong></label>
			<div class="row">
			    <div class="col">
					<div class="form-group">
						<input type="text" name="txtLastName" class="form-control" placeholder="Enter last name" required/>
					</div>
			    </div>
			    <div class="col">
					<div class="form-group">
						<input type="text" name="txtFirstName" class="form-control" placeholder="Enter first name" required/>
					</div>
			    </div>
			    <div class="col">
					<div class="form-group">
						<input type="text" name="txtMiddleName" class="form-control" placeholder="Enter middle name"/>
					</div>
			    </div>
			</div>
			<div class="form-group">
				<label><strong>E-Mail Address</strong></label>
				<input type="email" name="txtEmail" id="container-form-control" class="form-control" placeholder="Enter email address" required />
				<small id="emailHelp" class="form-text text-muted">It'll be best if it is a gmail address.</small>
			</div>
			<div class="row">
			    <div class="col-md-12">
		    		<h4>Applicant's Receipt</h4>
					<small id="contactHelp" class="form-text text-muted">Receipt from your copyright request fee. These fields are <span class="text-info">required.</span></small>
		    		<div class="row">
			        	<div class="col-md-4">
			        		<div class="form-group">
				        	{{ Form::label('lblReceiptCode', 'Receipt Code', ['style' => 'font-weight: bold;']) }}
				    		{{ Form::text('txtReceiptCode', '', ['class' => 'form-control', 'placeholder' => 'Enter receipt code', 'required']) }}
							<small id="contactHelp" class="form-text text-muted">Example: ###</small>
			        		</div>
			        	</div>
			        	<div class="col-md-8">
					        <div class="form-group">
					        	{{ Form::label('lblReceiptCode', 'Receipt', ['class' => 'control-label', 'style' => 'font-weight: bold;']) }}
					        	{{ Form::file('fileReceiptImg', ['class' => 'form-control', 'required']) }}
								<small id="contactHelp" class="form-text text-muted">Upload a photo of your transaction receipt.</small>	
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
	{!! Form::close() !!} 
	</div>
  </div> 

    </section>
    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('vali/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('vali/js/popper.min.js') }}"></script>
    <script src="{{ asset('vali/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vali/js/main.js') }}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('vali/js/plugins/pace.min.js') }}"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });

      $('[a href="/index-vali"]').addClass
    </script>
  </body>
</html>