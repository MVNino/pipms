@extends('author-pd.layouts.app')

@section('content')
<!-- Update Profile Picture -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Profile Photo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => ['Author\ProfileController@updateProfilePic', Auth::user()->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        @csrf
        <div class="form-group">
          <label for="input-file-user-profile-img" class="control-label"><b>User Profile Image</b></label>
          <input type="file" name="fileUserProfileImg" id="input-file-user-profile-img" class="dropify" data-default-file="/storage/images/profile/{{ Auth::user()->str_user_image_code }}" />
          <small class="form-text text-muted" id="fileHelp">Accepted file types: jpg, jpeg, png.</small>
        </div>
        <div class="modal-footer">
          {{ Form::hidden('_method', 'PUT') }}
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i> Update</button>  
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div> 
<!-- /Update Profile Picture -->

<div class="row">
    <div class="col-md-4">
      <div class="card card-user">
        <div class="image">
          <img src="{{ asset('pd/assets/img/damir-bosnjak.jpg') }}" alt="...">
        </div>
        <div class="card-body">
          <div class="author">
            <a href="#" data-toggle="modal" data-target="#exampleModalLong">
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
              <div class="col-lg-6 col-md-6 col-6 ml-auto">
                <h5>2
                  <br>
                  <small>Files Uploaded</small>
                </h5>
              </div>
              <div class="col-lg-6 col-md-6 col-6 ml-auto mr-auto">
                <h5>2
                  <br>
                  <small>IPR Applications</small>
                </h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">
            <a href="#" id="coAuthor">
              Co-Authors
            </a>
          </h4>
        </div>
        <div id="coAuthorBody">
            @foreach(Auth::user()->applicant->coAuthors as $coAuthor)
            <div class="card-body">
              <ul class="list-unstyled team-members">
                <li>
                  <div class="row">
                    <div class="col-md-2 col-2">
                      <div class="avatar">
                        <i class="fa fa-user fa-2x"></i>
                      </div>
                    </div>
                    <div class="col-md-7 col-7">
                      {{$coAuthor->str_first_name}} {{$coAuthor->str_middle_name}} 
                      {{$coAuthor->str_last_name}} <br />
                    </div>
                    <div class="col-md-3 col-3 text-right">
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card card-user">
        <div class="card-header">
          <h5 class="card-title">Edit Profile</h5>
        </div>
        <div class="card-body">
          {!! Form::open(['id' => 'formUpdateAuthor', 'action' => ['Author\ProfileController@updateAuthor', $author->int_id], 'method' => 'POST']) !!}
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
                  <input type="text" class="form-control" placeholder="Birthdate" value="{{ $author->dtm_birthdate->format('F d, Y') }}" readonly="">
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
              <div class="col-md-12">
                <div class="form-group">
                  <label>Department - College - Branch</label>
                  <select data-placeholder="Select department" class="custom-select" name="slctDepartmentId">
                    @if($author->int_department_id == NULL)
                      <option selected>Select department</option>
                    @else
                  <option value="{{ $author->int_department_id }}" selected>{{ $author->department->char_department_code }} - {{ $author->department->college->char_college_code }} - {{ $author->department->college->branch->str_branch_name }}</option>
                    @endif
                    @foreach($departments as $department)
                      @if($department->int_id !== $author->int_department_id)
                        <option value="{{ $department->int_id }}">{{ $department->char_department_code }} - {{ $department->college->char_college_code }} - {{ $department->college->branch->str_branch_name }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>          
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 pr-1">
                <div class="form-group">
                  <label>Branch</label>
                  <select data-placeholder="Select branch" id="branch" class="custom-select" name="slctBranchId">
                    <option selected>Select branch</option>
                    @foreach($branches as $branch)
                      <option value="{{ $branch->int_id }}">
                        {{ $branch->str_branch_name }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4 px-1">
                <div class="form-group">
                  <label>College</label>
                  <div id="divCollege">
                  </div>
                </div>
              </div>
              <div class="col-md-4 pl-1">
                <div class="form-group">
                  <label>Department</label>
                  <div id="divDepartment"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="update ml-auto mr-auto">
                {{ Form::hidden('_method', 'PUT') }}
                {{-- @captcha --}}
                <button type="button" id="demoSwal" class="btn btn-primary btn-round">Update Profile</button>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('pg-specific-js')
<script>
$(() => {
  
  $('#coAuthorBody').hide();
  let js = {
    go: function() {
      let collegeHtml = this.plainCollegeHtml();
      $("#divCollege").html(`<div id="divCollege">${collegeHtml}</div>`);
      let departmentHtml = this.plainDepartmentHtml();
      $("#divDepartment").html(`<div id="divDepartment">${departmentHtml}</div>`);
    },

    plainCollegeHtml: function() {
      return `<select data-placeholder="Select college" id="college" 
                  class="custom-select" name="slctCollegeId">
                <option selected>Select college</option>
              </select>`;
    },

    plainDepartmentHtml: function() {
      return `<select data-placeholder="Select department" id="department" 
                  class="custom-select" name="slctDepartmentId">
                <option selected>Select Department</option>
              </select>`;
    }
  };
  js.go();

  $('#coAuthor').click(() => {
    $('#coAuthorBody').toggle();
  });

  // if branch select menu is on change
  $("#branch").change(() => {
    let branchId = $("#branch").val();
    $.get(`/author/branch-colleges/${branchId}`, (response) => {
        collegeHtml = `<select data-placeholder="Select college" id="college" 
                        class="custom-select" name="slctCollegeId">
                      <option selected>Select college</option>`;
              $.each(response, (i, college) => {
                console.log(college.char_college_code);
                collegeHtml += `<option value="${college.int_id}">
                                  ${college.char_college_code}
                                </option>`;
              });
        collegeHtml += `</select>`;
        $('#divCollege').html(collegeHtml);
    });
  });

  // if college select menu is on change
  $("#college").change(() => {
    let collegeId = $('#college').val();
    console.log(collegeId);
    $.get(`/author/college-departments/${collegeId}`, (response) => {
      departmentHtml = `<select data-placeholder="Select department" id="department" 
                        class="custom-select" name="slctDepartmentId">
                      <option selected>Select department</option>`;
              $.each(response, (i, department) => {
                console.log(department.char_department_code);
                departmentHtml += `<option value="${department.int_id}">
                                  ${department.char_department_code}
                                </option>`;
              });
        departmentHtml += `</select>`;
        $('#divDepartment').html(departmentHtml);
    });
  });
});
</script>

{{-- Sweet Alert --}}
<script src="{{ asset('vali/js/plugins/sweetalert.min.js') }}"></script>
<script>
$('#demoSwal').click(function(){
  swal({
    title: "Are you sure?",
    text: "Your profile details will permanently change.",
    type: "info",
    showCancelButton: true,
    confirmButtonText: "Yes, update my account!",
    cancelButtonText: "Cancel",
    closeOnConfirm: false,
    closeOnCancel: false
  }, function(isConfirm) {
    if (isConfirm) {
      $('#formUpdateAuthor').submit();
      swal("Updated", "Your account has been updated!", "success");
    } else {
      swal("Cancelled", "The action has been cancelled!", "error");
    }
  });
});
</script>
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