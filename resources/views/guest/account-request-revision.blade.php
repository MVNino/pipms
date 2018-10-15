<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body id="body-guest">
  <div class="container-fluid" style="padding:0;margin:0;">
    @include('guest.includes.messages')
    <main>

<section class="material-half-bg">
  <div class="cover"></div>
</section>
<section class="login-content">
	<div class="logo">
    	<h1>Account Request Revision</h1>
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
							<option value="{{ $authorAccountRequest->char_applicant_type }}" selected>{{ $authorAccountRequest->char_applicant_type }}</option>
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
    </main>
  </div>
  <!-- Scripts -->
  <!-- Essential javascripts for application to work-->
  <script src="{{ asset('vali/js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('vali/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="{{ asset('vali/js/plugins/pace.min.js') }}"></script>
  @yield('pg-specific-js')
</body>
</html>