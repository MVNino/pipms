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
		{!! Form::open() !!}
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
				<div class="form-group col-md-4 col-sm-4">
		            <label><strong>Birthdate</strong></label><br>
					<input class="form-control" type="date" placeholder="Select Date" name="birthdate">
		        </div>
			</div>
			<br>
			<label><strong>Applicant's Name</strong></label>
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

			<div class="form-group">
				<label><strong>E-Mail Address</strong></label>
				<input type="text" name="txtEmail" id="container-form-control" class="form-control" placeholder="Enter email address" />
				<small id="emailHelp" class="form-text text-muted">It'll be best if it is a gmail address.</small>
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