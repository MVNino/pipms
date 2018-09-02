@extends('author.layouts.app-classimax')

@section('content')

       
     
        <!-- Edit Personal Info -->
        <div class="widget personal-info">
          <h3 class="widget-header user">Edit Personal Information</h3>
          <form action="#">
            <!-- First Name -->
            <div class="form-group">
                <label for="first-name">First Name</label>
                <input type="text" class="form-control" id="first-name">
            </div>
            <!-- Last Name -->
            <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" class="form-control" id="last-name">
            </div>
            <!-- File chooser -->
            <div class="form-group choose-file">
              <i class="fa fa-user text-center"></i>
                <input type="file" class="form-control-file d-inline" id="input-file">
             </div>
            <!-- Comunity Name -->
            <div class="form-group">
                <label for="comunity-name">Comunity Name</label>
                <input type="text" class="form-control" id="comunity-name">
            </div>
            <!-- Checkbox -->
            
            <!-- Zip Code -->
            
            <!-- Submit button -->
            <button class="btn btn-transparent">Save My Changes</button>
          </form>
        </div>
        <!-- Change Password -->
        <div class="widget change-password">
          <h3 class="widget-header user">Edit Password</h3>
          <form action="#">
            <!-- Current Password -->
            <div class="form-group">
                <label for="current-password">Current Password</label>
                <input type="password" class="form-control" id="current-password">
            </div>
            <!-- New Password -->
            <div class="form-group">
                <label for="new-password">New Password</label>
                <input type="password" class="form-control" id="new-password">
            </div>
            <!-- Confirm New Password -->
            <div class="form-group">
                <label for="confirm-password">Confirm New Password</label>
                <input type="password" class="form-control" id="confirm-password">
            </div>
            <!-- Submit Button -->
            <button class="btn btn-transparent">Change Password</button>
          </form>
        </div>
        <!-- Change Email Address -->
        <div class="widget change-email mb-0">
          <h3 class="widget-header user">Edit Email Address</h3>
          <form action="#">
            <!-- Current Password -->
            <div class="form-group">
                <label for="current-email">Current Email</label>
                <input type="email" class="form-control" id="current-email">
            </div>
            <!-- New email -->
            <div class="form-group">
                <label for="new-email">New email</label>
                <input type="email" class="form-control" id="new-email">
            </div>
            <!-- Submit Button -->
            <button class="btn btn-transparent">Change email</button>
          </form>
        </div>
      </div>
    

@endsection

