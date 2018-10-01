@include('guest.includes.head-content')
<section class="material-half-bg">
  <div class="cover"></div>
</section>
<section class="login-content">
  <div class="logo">
    <h1>Account Registration</h1>
  </div>
<div class="container">
<div class="row justify-content-center">

    <div class="col-md-8">
{!! Form::open(['action' => ['Transaction\RegisterAuthorController@grantAuthorAccount', $applicant->int_id], 'method' => 'POST', 'onsubmit' => "return confirm('Submit your author account registration form?')"]) !!}
	@csrf
      <div class="tile">
        <div class="tile-body">
			<label><strong>Name</strong></label>
			<div class="row">
			    <div class="col-md-4">
					<div class="form-group">
						<input type="text" name="txtLastName" class="form-control" placeholder="Enter last name" value="{{ $applicant->authorAccountRequest->str_last_name }}" required readonly/>
					</div>
			    </div>
			    <div class="col-md-4">
					<div class="form-group">
						<input type="text" name="txtFirstName" class="form-control" placeholder="Enter first name" value="{{ $applicant->authorAccountRequest->str_first_name }}" required readonly/>
					</div>
			    </div>
			    <div class="col-md-4">
					<div class="form-group">
						<input type="text" name="txtMiddleName" class="form-control" placeholder="Enter middle name" value="{{ $applicant->authorAccountRequest->str_middle_name }}" readonly/>
					</div>
			    </div>
			</div>
			<label><strong>Email Address</strong></label>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input type="email" name="txtEmail" class="form-control" placeholder="Enter email" value="{{ $applicant->authorAccountRequest->str_email }}" required readonly/>
					</div>
				</div>
			</div>
			<label><strong>Username</strong></label>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input type="text" name="txtUsername" class="form-control" placeholder="Enter username" required/>
					</div>
				</div>
			</div>
			<label><strong>Password</strong></label>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input type="password" name="txtPassword" class="form-control" placeholder="Enter password" required/>
					</div>
				</div>
			</div>
			<label><strong>Re-enter password</strong></label>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input type="password" name="txtRePassword" class="form-control" placeholder="Re-enter password" required />
	                    <p class="form-text text-muted">Note: Password must be consists of at least six characters (and the more characters, the stronger the password) that are a combination of letters, numbers and symbols (@, #, $, %, etc.).</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4 col-sm-4">
					<span></span>
				</div>
				<div class="col-md-4 col-sm-4">
					{{ Form::hidden('_method', 'PUT') }}
					@captcha()
					<button type="submit" class="btn btn-md btn-primary btn-block" style="font-size: 1.25em"><i class="fa fa-envelope" style="font-size: 20px;"></i>Submit</button>
				</div>
				<div class="col-md-4 col-sm-4">
					<span></span>
				</div>
			</div>
        </div>
    </div>
{!! Form::close() !!}
</div>
</div>
</div>