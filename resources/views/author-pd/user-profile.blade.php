@extends('author-pd.layouts.app')

@section('content')
<div class="row">
  <div class="col-md-4">
    <div class="card card-user">
      <div class="image">
        <img src="{{ asset('pd/assets/img/damir-bosnjak.jpg') }}" alt="...">
      </div>
      <div class="card-body">
        <div class="author">
          <a href="#">
            <img class="avatar border-gray" src="/storage/images/profile/lonlon.jpg" alt="...">
            <h5 class="title">Marlon Villa Niño</h5>
          </a>
          <p class="description text-muted">
            ninomarlonvilla@gmail.com
          </p>
        </div>
        <p class="description text-center">
          "I may be one of the lowest now,
          <br> But it is not
          <br> <i>FOREVER</i>"
        </p>
      </div>
      <div class="card-footer">
        <hr>
        <div class="button-container">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-6 ml-auto">
              <h5>12
                <br>
                <small>Files</small>
              </h5>
            </div>
            <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
              <h5>2GB
                <br>
                <small>Used</small>
              </h5>
            </div>
            <div class="col-lg-3 mr-auto">
              <h5>24,6$
                <br>
                <small>Spent</small>
              </h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Co-Authors</h4>
      </div>
      <div class="card-body">
        <ul class="list-unstyled team-members">
          <li>
            <div class="row">
              <div class="col-md-2 col-2">
                <div class="avatar">
                  <img src="{{ asset('pd/') }}../assets/img/faces/ayo-ogunseinde-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                </div>
              </div>
              <div class="col-md-7 col-7">
                DJ Khaled
                <br />
                <span class="text-muted">
                  <small>Offline</small>
                </span>
              </div>
              <div class="col-md-3 col-3 text-right">
                <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-envelope"></i></btn>
              </div>
            </div>
          </li>
          <li>
            <div class="row">
              <div class="col-md-2 col-2">
                <div class="avatar">
                  <img src="{{ asset('pd/') }}../assets/img/faces/joe-gardner-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                </div>
              </div>
              <div class="col-md-7 col-7">
                Creative Tim
                <br />
                <span class="text-success">
                  <small>Available</small>
                </span>
              </div>
              <div class="col-md-3 col-3 text-right">
                <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-envelope"></i></btn>
              </div>
            </div>
          </li>
          <li>
            <div class="row">
              <div class="col-md-2 col-2">
                <div class="avatar">
                  <img src="{{ asset('pd/') }}../assets/img/faces/clem-onojeghuo-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                </div>
              </div>
              <div class="col-ms-7 col-7">
                Flume
                <br />
                <span class="text-danger">
                  <small>Busy</small>
                </span>
              </div>
              <div class="col-md-3 col-3 text-right">
                <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-envelope"></i></btn>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Edit Profile</h5>
      </div>
      <div class="card-body">
        <form>
          <div class="row">
            <div class="col-md-4 pr-1">
              <div class="form-group">
                <label>Type of Author</label>
                <input type="text" class="form-control" placeholder="Company" value="Student" readonly="">
              </div>
            </div>
            <div class="col-md-4 px-1">
              <div class="form-group">
                <label>Gender</label>
                <input type="text" class="form-control" placeholder="Gender" value="Male" readonly="">
              </div>
            </div>
            <div class="col-md-4 pl-1">
              <div class="form-group">
                <label for="exampleInputEmail1">Birthdate</label>
                <input type="text" class="form-control" placeholder="Birthdate" value="01/23/1998" readonly="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 pr-1">
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" placeholder="Username">
              </div>
            </div>
            <div class="col-md-6 px-1">
              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Email" value="ninomarlonvilla@gmail.com" readonly="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 pr-1">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" placeholder="Company" value="Chet">
              </div>
            </div>
            <div class="col-md-4 pr-1">
              <div class="form-group">
                <label>Middle Name</label>
                <input type="text" class="form-control" placeholder="Company" value="Chet">
              </div>
            </div>
            <div class="col-md-4 pl-1">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" placeholder="Last Name" value="Faker">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" placeholder="Home Address" value="Melbourne, Australia">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 pr-1">
              <div class="form-group">
                <label>Cellphone Number</label>
                <input type="text" class="form-control" placeholder="Cellphone Number">
              </div>
            </div>
            <div class="col-md-6 pl-1">
              <div class="form-group">
                <label>Telephone Number</label>
                <input type="text" class="form-control" placeholder="Telephone Number">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 pr-1">
              <div class="form-group">
                <label>Branch</label>
                <select data-placeholder="Select branch" class="custom-select" name="slctBranchId">
                  <option selected>Select branch</option>
                    <option>PUP Main</option>
                </select>
              </div>
            </div>
            <div class="col-md-4 px-1">
              <div class="form-group">
                <label>College</label>
                <select data-placeholder="Select college" class="custom-select" name="slctCollegeId">
                  <option selected>Select college</option>
                    <option>CCIS</option>
                </select>
              </div>
            </div>
            <div class="col-md-4 pl-1">
              <div class="form-group">
                <label>Department</label>
                <select data-placeholder="Select department" class="custom-select" name="slctDepartmentId">
                  <option selected>Select department</option>
                    <option>BSIT</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="update ml-auto mr-auto">
              <button type="submit" class="btn btn-primary btn-round">Update Profile</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection