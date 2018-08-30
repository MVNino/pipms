@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-user"></i> Accounts</h1>
  <p>A listing of website's accounts</p>
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
      <a role="button" href="#" class="btn btn-primary mb-2 float-right" disabled><i class="fa fa-plus"></i>Add another account</a>
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
                <th scope="col" class="text-center">Details</th>
              </tr>
            </thead>
            <tbody>
              @forelse($users as $user)
              <tr>
              <td scope="row">{{ $user->id }}</td>
              <td>{{ $user->str_first_name }} {{ $user->str_middle_name }} {{ $user->str_last_name }}</td>
              <td>{{ $user->email }}</td>
              <td class="text-center"><a href="/admin/maintenance/user/{{ $user->id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span>View</a></td>
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