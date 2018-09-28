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
              <img class="avatar border-gray" src="/storage/images/profile/{{ Auth::user()->str_user_image_code }}" alt="author profile image">
              <h5 class="title">{{ Auth::user()->str_first_name }} {{ Auth::user()->str_middle_name }} {{ Auth::user()->str_last_name }}</h5>
            </a>
            <p class="description text-muted">
              {{ Auth::user()->email }}
            </p>
          </div>
          <p class="description text-center">
            Last sign in:
            <br> <b>Wednesday</b>
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
        @foreach($coAuthors as $coAuthor)
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
                  {{$coAuthor->str_first_name}} {{$coAuthor->str_middle_name}} {{$coAuthor->str_last_name}}
                  <br />
                </div>
                <div class="col-md-3 col-3 text-right">
                  <button class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-envelope"></i></button>
                </div>
              </div>
            </li>
          </ul>
        </div>
        @endforeach
      </div>
    </div>
    <div class="col-md-8">
      <div class="card card-user">
        <div class="card-header">
          <h5 class="card-title">Edit Profile</h5>
        </div>
        <div class="card-body">
          {!! Form::open(['action' => ['Author\ProfileController@updateAuthor', $author->int_id], 'method' => 'POST', 'onsubmit' => "return confirm('Edit your profile?')"]) !!}
            @csrf
            <div class="row">
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>Type of Author</label>
                  <input type="text" class="form-control" placeholder="Type of Author" value="{{ $author->char_applicant_type }}" readonly="">
                </div>
              </div>
              <div class="col-md-4 px-1">
                <div class="form-group">
                  <label>Gender</label>
                  @if($author->char_gender == 'M')
                  <input type="text" class="form-control" placeholder="Gender" value="Male" readonly="">
                  @else
                  <input type="text" class="form-control" placeholder="Gender" value="Female" readonly="">
                  @endif
                </div>
              </div>
              <div class="col-md-4 pl-1">
                <div class="form-group">
                  <label>Birthdate</label>
                  <input type="text" class="form-control" placeholder="Birthdate" value="{{ $author->dtm_birthdate }}" readonly="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="txtUsername" class="form-control" placeholder="Enter username" value="{{ auth()->user()->str_username }}">
                </div>
              </div>
              <div class="col-md-6 px-1">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="txtEmail" class="form-control" placeholder="Email" value="{{ auth()->user()->email }}" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" name="txtLastName" class="form-control" placeholder="Enter lastname" value="{{ Auth::user()->str_last_name }}">
                </div>
              </div>
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>First Name</label>
                  <input type="text" name="txtFirstName" class="form-control" placeholder="Enter firstname" value="{{ Auth::user()->str_first_name }}">
                </div>
              </div>
              <div class="col-md-4 pl-1">
                <div class="form-group">
                  <label>Middle Name</label>
                  <input type="text" name="txtMiddleName" class="form-control" placeholder="Enter middlename" value="{{ Auth::user()->str_middle_name }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Address</label>
                <input type="text" name="txtHomeAddress" class="form-control" placeholder="Enter home address" value="{{ $author->str_home_address }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>Cellphone Number</label>
                <input type="text" name="txtMobileNumber" class="form-control" placeholder="Enter cellphone number" value="{{ $author->bigInt_cellphone_number }}">
                </div>
              </div>
              <div class="col-md-6 pl-1">
                <div class="form-group">
                  <label>Telephone Number</label>
                  <input type="text" name="txtTelephoneNumber" class="form-control" placeholder="Enter telephone number" value="{{ $author->mdmInt_telephone_number }}">
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
                    @if($author->int_department_id == NULL)
                      <option selected>Select department</option>
                    @else
                  <option value="{{ $author->int_department_id }}" selected>{{ $author->department->char_department_code }}</option>
                    @endif
                    @foreach($departments as $department)
                      @if($department->int_id !== $author->int_department_id)
                        <option value="{{ $department->int_id }}">{{ $department->char_department_code }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="update ml-auto mr-auto">
                {{ Form::hidden('_method', 'PUT') }}
                <!-- @captcha -->
                <button type="submit" class="btn btn-primary btn-round">Update Profile</button>
                <button type="button" onclick="updateProfile()" class="btn btn-primary btn-round">Update Profile</button>
                <a class="btn btn-info" id="demoSwal" href="#">UPdate moto</a>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('pg-specific-js')
<script src="{{ asset('vali/js/plugins/sweetalert.min.js') }}"></script>
<script>
$('#demoSwal').click(function(){
  swal({
    title: "Are you sure?",
    text: "You will not be able to recover this imaginary file!",
    type: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No, cancel plx!",
    closeOnConfirm: false,
    closeOnCancel: false
  }, function(isConfirm) {
    if (isConfirm) {
      swal("Deleted!", "Your imaginary file has been deleted.", "success");
      $.post('',data,function(response){

      }); 

    } else {
      swal("Cancelled", "Your imaginary file is safe :)", "error");
    }
  });
});
</script>
@endsection