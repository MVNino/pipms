@extends('author.layouts.app-classimax')

@section('content')
<main class="app-content">    
<h4 class="line-head">Setting My Account</h4>
<form>
  <div class="row mb-4">
    <div class="col-md-4">
      <label>Last Name</label>
      <input class="form-control" type="text" placeholder="Enter Last Name" required>
    </div>

    <div class="col-md-4">
      <label>Middle Name</label>
      <input class="form-control" type="text" placeholder="Enter Middle Name" required>
    </div>

    <div class="col-md-4">
      <label>First Name</label>
      <input class="form-control" type="text" placeholder="Enter First Name" required>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 mb-4">
      <label>Email</label>
      <input class="form-control" type="text" placeholder="Enter Email Address" required>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-4">
      <label>Mobile No</label>
      <input class="form-control" type="text" placeholder="Enter Mobile Number" required>
    </div>
    <div class="col-md-6 mb-4">
      <label>Telephone No</label>
      <input class="form-control" type="text" placeholder="Enter Telephone Number" required>
    </div>    
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 mb-4">
      <label>Home Address</label>
      <input class="form-control" type="text" placeholder="Enter Complete Address" required>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="row mb-4">  
    <div class="col-md-4 col-sm-12">
      <label>Branch</label><br>
      <select class="custom-select" name="slctBranch" id="branch" required>
        <option>Select branch</option>
      </select>
    </div>
    <div class="col-md-4 col-sm-12">
      <label>College</label><br>
      <select class="custom-select" name="slctCollege" id="college" required>
        <option>Select college</option>
      </select>
    </div>
    <div class="col-md-4 col-sm-12">
      <label>Department</label><br>
      <select class="custom-select" name="slctDepartment" id="department" required>
        <option>Select department</option>
      </select>
    </div>
  </div>
  <div class="row mb-10">
    <div class="col-md-12">
      <button class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
    </div>
  </div>
</form>         
</main> 
@endsection

@section('pg-specific-js')
 <script>
  $(document).ready(function(){
    $('#li-my-account').addClass('active');
  });
 </script>
 @endsection