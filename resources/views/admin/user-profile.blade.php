@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> My Account</h1>
  <p>Information about the user</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">
  <a href="{{ route('admin.user-profile') }}">My Account</a>
</li>
@endsection
@section('content')
<br/><div class="row user">
    <div class="col-md-12">
      <div class="profile">
        <div class="info">
          <a href="#" data-toggle="modal" data-target="#exampleModalLong">
            <img class="user-img" src="/storage/images/profile/{{ Auth::user()->str_user_image_code }}">
          </a>
          <h4>Administrator</h4>
          <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Update Profile Photo</button>
        </div>
        <div class="cover-image"></div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="tile p-0">
        <ul class="nav flex-column nav-tabs user-tabs">
          <li class="nav-item"><a class="nav-link active" href="#user-notifications" data-toggle="tab">Notifications</a></li>
          <li class="nav-item"><a class="nav-link" href="#user-settings" data-toggle="tab">Settings</a></li>
          <li class="nav-item"><a class="nav-link" href="#user-change-password" data-toggle="tab">Change Password</a></li>
        </ul>
      </div>
    </div>
    <div class="col-md-9">
      <div class="tab-content">
        <div class="tab-pane active" id="user-notifications">
        <div class="tile">
          <div class="tile-body">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#all">All</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#unread">Unread</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#read">Read</a></li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="all">
                    <div class="bs-component">
                      <div class="list-group">
                        @forelse(auth()->user()->notifications as $notification)
                          @if($notification->created_at->diffInDays(Carbon\Carbon::now()) == 0)
                                @if($notification->created_at->diffInHours(Carbon\Carbon::now()) > 0)
                                  @if($notification->created_at->diffInHours(Carbon\Carbon::now()) == 1)
                                  <label class="list-group-item list-group-item-action">
                              <strong>An hour ago</strong> - {!! $notification->data['data'] !!}
                            </label>
                                  @else
                                  <label class="list-group-item list-group-item-action">
                              <strong>{{ $notification->created_at->diffInHours(Carbon\Carbon::now()) }} hours ago</strong> - {!! $notification->data['data'] !!}
                            </label>
                                  @endif
                                @else
                                  @if($notification->created_at->diffInMinutes(Carbon\Carbon::now()) <= 1)
                                  <label class="list-group-item list-group-item-action">
                              <strong>A minute ago</strong> - {!! $notification->data['data'] !!}
                            </label>
                                  @else
                                  <label class="list-group-item list-group-item-action">
                              <strong>{{ $notification->created_at->diffInMinutes(Carbon\Carbon::now()) }} minutes ago
                              </strong> - {!! $notification->data['data'] !!}
                            </label>
                                  @endif
                                @endif                    
                              @elseif($notification->created_at->diffInDays(Carbon\Carbon::now()) == 1)
                            <label class="list-group-item list-group-item-action">
                            <strong>Yesterday, {{ $notification->created_at->format('h:i:A') }}</strong> - {!! $notification->data['data'] !!}
                          </label>
                              @elseif($notification->created_at->diffInDays(Carbon\Carbon::now()) == 2)
                              <label class="list-group-item list-group-item-action">
                            <strong>2 days ago at {{ $notification->created_at->format('h:i:A') }}</strong> - {!! $notification->data['data'] !!}
                        </label>
                              @else
                              <label class="list-group-item list-group-item-action">
                            <strong>{{ $notification->created_at->format('M d')}}</strong> - {!! $notification->data['data'] !!}
                        </label>  
                              @endif
           
                        @empty
                        <a class="list-group-item list-group-item-action disabled" href="#">
                          There is no notification yet.
                        </a>
                        @endforelse
                      </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="unread">
                    <div class="bs-component">
                      <div class="list-group">
                        @forelse(auth()->user()->unReadNotifications as $notification)
                          @if($notification->created_at->diffInDays(Carbon\Carbon::now()) == 0)
                                @if($notification->created_at->diffInHours(Carbon\Carbon::now()) > 0)
                                  @if($notification->created_at->diffInHours(Carbon\Carbon::now()) == 1)
                                  <label class="list-group-item list-group-item-action">
                              <strong>An hour ago</strong> - {!! $notification->data['data'] !!}
                            </label>
                                  @else
                                  <label class="list-group-item list-group-item-action">
                              <strong>{{ $notification->created_at->diffInHours(Carbon\Carbon::now()) }} hours ago</strong> - {!! $notification->data['data'] !!}
                            </label>
                                  @endif
                                @else
                                  @if($notification->created_at->diffInMinutes(Carbon\Carbon::now()) <= 1)
                                  <label class="list-group-item list-group-item-action">
                              <strong>A minute ago</strong> - {!! $notification->data['data'] !!}
                            </label>
                                  @else
                                  <label class="list-group-item list-group-item-action">
                              <strong>{{ $notification->created_at->diffInMinutes(Carbon\Carbon::now()) }} minutes ago
                              </strong> - {!! $notification->data['data'] !!}
                            </label>
                                  @endif
                                @endif                    
                              @elseif($notification->created_at->diffInDays(Carbon\Carbon::now()) == 1)
                            <label class="list-group-item list-group-item-action">
                            <strong>Yesterday, {{ $notification->created_at->format('h:i:A') }}</strong> - {!! $notification->data['data'] !!}
                          </label>
                              @elseif($notification->created_at->diffInDays(Carbon\Carbon::now()) == 2)
                              <label class="list-group-item list-group-item-action">
                            <strong>2 days ago at {{ $notification->created_at->format('h:i:A') }}</strong> - {!! $notification->data['data'] !!}
                        </label>
                              @else
                              <label class="list-group-item list-group-item-action">
                            <strong>{{ $notification->created_at->format('M d')}}</strong> - {!! $notification->data['data'] !!}
                        </label>  
                              @endif
           
                        @empty
                        <label class="list-group-item list-group-item-action disabled" href="#">
                          There is no notification yet.
                        </label>
                            
                        @endforelse
                      </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="read">
                    <div class="bs-component">
                      <div class="list-group">
                        @forelse(auth()->user()->readNotifications as $notification)
                          @if($notification->created_at->diffInDays(Carbon\Carbon::now()) == 0)
                                @if($notification->created_at->diffInHours(Carbon\Carbon::now()) > 0)
                                  @if($notification->created_at->diffInHours(Carbon\Carbon::now()) == 1)
                                  <label class="list-group-item list-group-item-action">
                              <strong>An hour ago</strong> - {!! $notification->data['data'] !!}
                            </label>
                                  @else
                                  <label class="list-group-item list-group-item-action">
                              <strong>{{ $notification->created_at->diffInHours(Carbon\Carbon::now()) }} hours ago</strong> - {!! $notification->data['data'] !!}
                            </label>
                                  @endif
                                @else
                                  @if($notification->created_at->diffInMinutes(Carbon\Carbon::now()) <= 1)
                                  <label class="list-group-item list-group-item-action">
                              <strong>A minute ago</strong> - {!! $notification->data['data'] !!}
                            </label>
                                  @else
                                  <label class="list-group-item list-group-item-action">
                              <strong>{{ $notification->created_at->diffInMinutes(Carbon\Carbon::now()) }} minutes ago
                              </strong> - {!! $notification->data['data'] !!}
                            </label>
                                  @endif
                                @endif                    
                              @elseif($notification->created_at->diffInDays(Carbon\Carbon::now()) == 1)
                            <label class="list-group-item list-group-item-action">
                            <strong>Yesterday, {{ $notification->created_at->format('h:i:A') }}</strong> - {!! $notification->data['data'] !!}
                          </label>
                              @elseif($notification->created_at->diffInDays(Carbon\Carbon::now()) == 2)
                              <label class="list-group-item list-group-item-action">
                            <strong>2 days ago at {{ $notification->created_at->format('h:i:A') }}</strong> - {!! $notification->data['data'] !!}
                        </label>
                              @else
                              <label class="list-group-item list-group-item-action">
                            <strong>{{ $notification->created_at->format('M d')}}</strong> - {!! $notification->data['data'] !!}
                        </label>  
                              @endif
           
                        @empty
                        <label class="list-group-item list-group-item-action disabled" href="#">
                          There is no notification yet.
                        </label>  
                        @endforelse
                      </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        </div>
        <div class="tab-pane fade" id="user-settings">
          <div class="tile user-settings">
            <h4 class="line-head">Settings</h4>
            {!! Form::open(['id' => 'formUserProfile', 'action' => ['Admin\ProfileController@updateUserProfile', auth()->user()->id], 'method' => 'POST']) !!}
              @csrf
              <div class="row mb-4">
                <div class="col-md-4">
                  <label>Last Name</label>
                  <input class="form-control" name="txtLastName" type="text" value="{{ auth()->user()->str_last_name }}">
                </div>
                <div class="col-md-4">
                  <label>First Name</label>
                  <input class="form-control" name="txtFirstName" type="text" value="{{ auth()->user()->str_first_name }}">
                </div>
                <div class="col-md-4">
                  <label>Middle Name</label>
                  <input class="form-control" name="txtMiddleName" type="text" value="{{ auth()->user()->str_middle_name }}">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-4">
                  <label>Username</label>
                  <input class="form-control" name="txtUsername" type="text" value="{{ auth()->user()->str_username }}">
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 mb-4">
                  <label>Email</label>
                  <input class="form-control" name="txtEmail" type="text" value="{{ auth()->user()->email }}" readonly>
                </div>
              </div>
              <div class="row mb-10">
                <div class="col-md-12">
                  {{ Form::hidden('_method', 'PUT') }}
                  <button class="btn btn-primary float-right" type="button" id="demoSwal"><i class="fa fa-fw fa-lg fa-check-circle"></i> Update</button>
                  
                </div>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
        <div class="tab-pane fade" id="user-change-password">
          <div class="tile user-settings">
            <h4 class="line-head">Change Password</h4>
            {!! Form::open() !!}
              @csrf
              <div class="row mb-4">
                <label>Current Password</label>
                <input class="form-control" name="txtCurrentPassword" type="password" placeholder="Enter current password">
              </div>
              <div class="row mb-4">
                <label>New Password</label>
                <input class="form-control" name="txtNewPassword" type="password" placeholder="Enter new password">
              </div>
              <div class="row mb-4">
                <label>Re-type New Password</label>
                <input class="form-control" name="txtRetypeNewPassword" type="password" placeholder="Re-enter your new password">
              </div>
              <button class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>


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
        {!! Form::open(['action' => ['Admin\ProfileController@updateProfilePic', Auth::user()->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
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
@endsection

@section('pg-specific-js')
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
      $('#formUserProfile').submit();
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