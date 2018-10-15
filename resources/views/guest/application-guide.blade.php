@extends('guest.layouts.app')

@section('content')
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
  <div class="logo">
      <h1>Ipr Application</h1>
  </div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="head" style="text-align: center">
          <h2 class="text-muted"><br>Application Process</h2><br>
        </div>
          <div class="row">
          <div class="column">        
          <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 1. Go to PIPMS Website and fill up the <a href="/registration/author">application request form</a>.</p>
          <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp a. Select your type of applicant (student, graduate student, professor), your gender and birthdate. </p>
          <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp b. Upload receipt picture and enter receipt code.</p>
          <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 2. Click SUBMIT. Wait for the confirmation of your request that will be sent to your email address.</p>

          <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 3. Click the attached link which contains the copyright/patent registration form sent to your email address.</p>

          <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 4. Fill up the information and details about your project.</p>
          
          <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp a. Enter your contact details and your co-authors (optional).</p>

          <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp b. Detail your project for copyright registration and its executive summary.</p>

          <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp *Please take note of the following requirements needed for your actual copyright/patent registration in the office.</p>

          <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp5. Click SUBMIT. Wait for the confirmation of your appointed schedule in your email account. Please comply immediately if there is any revision in your registration.</p> 
          <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspThe said revision will also be sent to you via email.</p>

          <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp6. We will process and evaluate your application. We will notify you on the progress of your application consistently.</p>
          
        </div>
      </div>
    </div>
  </div>
</div>
</div>  
  <div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="head" style="text-align: center">
          <h3 class="text-muted"><br>A copyright owner is entitled to the following rights:</h3><br>
        </div>
          <div class="row">
            <div class="col-md-7">   
              <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp• Produce the work in public</p>
              
              <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp• Publish the work</p>
              <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp•  Perform the work in public</p>
              <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp•  Translate the work</p>

              <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp•  Make any cinematograph film or a record in respect of the work</p>
              <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp•  Broadcast the work</p>
              <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp•  Make an adaptation of the work</p>
              <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp•  Make copies of the work and distribute the work</p>
              <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp•  Make derivatives of the work</p>
              <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp•  Prevent others from making unauthorized use of copyrighted work</p>
              <a role="button" href="/storage/files/Requirements Document.zip" class="btn btn-primary">
                <i class="fa fa-download"></i> Download requirement documents
              </a>
            </div>
          </div>
        </div>
      </div>
</div>
</div>
</div>
</div>
</section>
@endsection

@section('pg-specific-js')
<script>
  $(document).ready(function(){
    $('#dropdown-ipr').css('color', 'maroon');
    $('#dropdown-ipr').css('border-bottom', '1px solid rgb(136,136,129)');
  });
</script>
@endsection