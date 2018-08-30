<!DOCTYPE html>
<html lang="en">
  <head>
    @include('author.includes.head-content')
  <style>
    body {
      padding-bottom: 0;
    }
  </style>
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    @include('author.includes.navbar')
    <!-- Sidebar menu-->
    @include('author.includes.sidebar')
    <main class="app-content">
      <div class="row user">
        @include('author.includes.messages') 
        <div class="col-md-12">
          <div class="profile">
            <div class="info"><img class="user-img" src="/storage/images/profile/{{ auth()->user()->str_user_image_code }}">
              <h4>John Doe</h4>
              <p>Author</p>
            </div>
            <div class="cover-image"></div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
              <li class="nav-item"><a class="nav-link active" href="#user-timeline" data-toggle="tab">Timeline</a></li>
              <li class="nav-item"><a class="nav-link" href="#user-settings" data-toggle="tab">Edit Profile</a></li>
              <li class="nav-item"><a class="nav-link" href="#" data-toggle="tab">Change Password</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            <div class="tab-pane active" id="user-timeline">
              <div class="timeline-post">
                <div class="post-media"><a href="#"><img src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg"></a>
                  <div class="content">
                    <h5><a href="#">{{ auth()->user()->str_first_name }} {{ auth()->user()->str_last_name }}</a></h5>
                    <p class="text-muted"><small>2 January at 9:30</small></p>
                  </div>
                </div>
                <div class="post-content">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,  quis tion ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <ul class="post-utility">
                  <li class="likes"><a href="#"><i class="fa fa-fw fa-lg fa-thumbs-o-up"></i>Like</a></li>
                  <li class="shares"><a href="#"><i class="fa fa-fw fa-lg fa-share"></i>Share</a></li>
                  <li class="comments"><i class="fa fa-fw fa-lg fa-comment-o"></i> 5 Comments</li>
                </ul>
              </div>
              <div class="timeline-post">
                <div class="post-media"><a href="#"><img src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg"></a>
                  <div class="content">
                    <h5><a href="#">{{ auth()->user()->str_first_name }} {{ auth()->user()->str_last_name }}</a></h5>
                    <p class="text-muted"><small>2 January at 9:30</small></p>
                  </div>
                </div>
                <div class="post-content">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,  quis tion ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <ul class="post-utility">
                  <li class="likes"><a href="#"><i class="fa fa-fw fa-lg fa-thumbs-o-up"></i>Like</a></li>
                  <li class="shares"><a href="#"><i class="fa fa-fw fa-lg fa-share"></i>Share</a></li>
                  <li class="comments"><i class="fa fa-fw fa-lg fa-comment-o"></i> 5 Comments</li>
                </ul>
              </div>
            </div>
            <div class="tab-pane fade" id="user-settings">
              <div class="tile user-settings">
                <h4 class="line-head">Settings</h4>
                {!! Form::open(['action' => ['AuthorController@updateAuthor', auth()->user()->applicant->int_id], 'method' => 'POST']) !!}
                  <div class="row mb-4">
                    <div class="col-md-4">
                      <label>First Name</label>
                      <input class="form-control" type="text" name="txtFirstName" value="{{ auth()->user()->str_first_name }}" placeholder="Enter firstname">
                    </div>
                    <div class="col-md-4">
                      <label>Middle Name</label>
                      <input class="form-control" type="text" name="txtMiddleName" value="{{ auth()->user()->str_middle_name }}" placeholder="Enter middlename">
                    </div>
                    <div class="col-md-4">
                      <label>Last Name</label>
                      <input class="form-control" type="text" name="txtLastName" value="{{ auth()->user()->str_last_name }}" placeholder="Enter lastname">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8 mb-4">
                      <label>Email</label>
                      <input class="form-control" type="text" name="txtEmail" value="{{ auth()->user()->email }}" placeholder="Enter email Address">
                    </div>
                    <div class="col-md-4 mb-4">
                      <label>Username</label>
                      <input class="form-control" type="text" name="txtUsername" value="{{ auth()->user()->str_username }}" placeholder="Enter username">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6 mb-4">
                      <label>Mobile Number</label>
                      <input class="form-control" type="text" name="txtMobileNumber" value="{{ auth()->user()->applicant->bigInt_cellphone_number }}" placeholder="Enter mobile number">
                    </div>
                    <div class="col-md-6 mb-4">
                      <label>Telephone Number</label>
                      <input class="form-control" type="text" name="txtTelephoneNumber" value="{{ auth()->user()->applicant->mdmInt_telephone_number }}" placeholder="Enter telephone number">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 mb-4">
                      <label>Home Address</label>
                      <input class="form-control" type="text" name="txtHomeAddress" value="{{ auth()->user()->applicant->str_home_address }}" placeholder="Enter home address">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-4 mb-4">
                    <label>Branch</label>
                    <select class="custom-select" name="slctBranch" id="branch" required>
             
                      <option>Select branch</option>
                    
                      @forelse($branches as $branch)
                          <option value="{{ $branch->int_id }}">{{ $branch->str_branch_name }}</option>
                      @empty
                      @endforelse
                    </select>
                  </div>
                  <div class="col-md-4 mb-4">
                    <label>College</label>
                    <select class="custom-select" name="slctCollege" id="college" required>
                   
                      <option>Select college</option>
                      @forelse($colleges as $college)
                          <option value="{{ $college->int_id }}">{{ $college->char_college_code }} - {{ $college->str_college_name }}</option>
                        
                      @empty
                      @endforelse
                    </select>
                  </div>
                  <div class="col-md-4 mb-4">
                    <label>Department</label>
                    <select class="custom-select" name="slctDepartment" id="department" required>
                   
                      <option>Select department</option>
                      @forelse($departments as $department)
                          <option value="{{ $department->int_id }}">{{ $department->char_department_code }} - {{ $department->str_department_name }}</option>
                        
                      @empty
                      @endforelse
                    </select>
                  </div>
                  </div>
                  <div class="row mb-10">
                    <div class="col-md-12">
                      {{ Form::hidden('_method', 'PUT') }}
                      <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>  
    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('vali/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('vali/js/popper.min.js') }}"></script>
    <script src="{{ asset('vali/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vali/js/main.js') }}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('vali/js/plugins/pace.min.js') }}"></script>
    @yield('pg-specific-js')
    @stack('article-ckeditor-script')
  </body>
</html>