@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-user"></i> Accounts</h1>
  <p>A listing of website's administrator accounts</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/accounts">Accounts</a></li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-11">
        <span></span>
    </div>
    <div class="col-md-1">
      <!-- Button trigger modal -->
      <a role="button" href="#" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModalLong">
        <i class="fa fa-plus"></i>Add administrator
      </a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th scope="col">Account ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email Address</th>
                <th scope="col">Username</th>
                {{-- <th scope="col" class="text-center">Details</th> --}}
              </tr>
            </thead>
            <tbody>
              @forelse($users as $user)
              <tr>
              <td scope="row">{{ $user->id }}</td>
              <td>{{ $user->str_first_name }} {{ $user->str_middle_name }} {{ $user->str_last_name }}</td>
              <td>{{ $user->email }}</td>
              {{-- <td class="text-center"><a href="/admin/maintenance/user/{{ $user->id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span>View</a></td> --}}
              <td>{{ $user->str_username }}</td>
              </tr>
              @empty	
              	<div class="alert alert-warning">
        					There is no record yet.
        				</div>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

<!-- Add user modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Administrator</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => 'Maintenance\AccountController@addAnotherAdmin', 'method' => 'POST']) !!}
        <div class="form-group">
          {{Form::label('lblFirstName', 'First Name *', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtFirstName', '', ['class' => 'form-control', 'placeholder' => 'Enter first name', 'required'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblMiddleName', 'Middle Name', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtMiddleName', '', ['class' => 'form-control', 'placeholder' => 'Enter middle name'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblLastName', 'Last Name *', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtLastName', '', ['class' => 'form-control', 'placeholder' => 'Enter last name', 'required'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblUsername', 'Username', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtUsername', '', ['class' => 'form-control', 'placeholder' => 'Enter username', 'required'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblEmail', 'Email *', ['style' => 'font-weight: bold'])}} 
          {{Form::email('txtEmail', '', ['class' => 'form-control', 'placeholder' => 'Enter email address', 'required'])}}
        </div>
        <div class="form-group">
          <label><strong>Password *</strong></label>
          <input type="password" name="txtPassword" class="form-control" placeholder="Enter password" required/>
        </div>
        <div class="form-group">
          <label><strong>Re-enter password *</strong></label>
          <input type="password" name="txtRePassword" class="form-control" placeholder="Re-enter password" required />
          <p class="form-text text-muted">
            Note: Password must be consists of at least six characters 
            (and the more characters, the stronger the password) that are a 
            combination of letters, numbers and symbols (@, #, $, %, etc.).</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fa fa-fw fa-lg fa-times-circle"></i>Close
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="fa fa-fw fa-lg fa-check-circle"></i> Save
          </button>  
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div> 
<!-- /Add user modal -->
@section('pg-specific-js')
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-maintenance').addClass('is-expanded');
    $('a[href="/admin/maintenance/accounts"]').addClass('active');
  });
</script>
@endsection
@endsection