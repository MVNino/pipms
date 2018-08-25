@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> Branches</h1>
  <p>A listing of PUP branches</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/branches">Branches</a></li>
@endsection

@section('content')
<!-- Add branch modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Branch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => 'Maintenance\BranchController@addBranch', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
          {{Form::label('lblBranchName', 'Branch Name', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtBranchName', '', ['class' => 'form-control', 'placeholder' => 'Enter branch name', 'required'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblBranchAddress', 'Branch Address', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtBranchAddress', '', ['class' => 'form-control', 'placeholder' => 'Enter branch address', 'required'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblBranchDescription', 'Branch Description', ['style' => 'font-weight: bold'])}}
          {{Form::textarea('txtAreaBranchDescription', '', ['id' => 'container-form-control article-ckeditor', 'class' => 'form-control', 'placeholder' => "Enter branch description *optional field*", 'rows' => '4'])}}
        </div>
        <div class="form-group">
          {{ Form::label('lblBranchProfileImg', 'Branch Profile Image', ['class' => 'control-label', 'style' => 'font-weight: bold']) }}
          {{ Form::file('fileBranchProfileImg', ['class' => 'form-control form-control-file']) }}
          <small class="form-text text-muted" id="fileHelp">Accepted file types: jpg, jpeg, png. This field is optional</small>
        </div>
        <div class="form-group">
          {{ Form::label('lblBranchBannerImg', 'Branch Banner Image', ['class' => 'control-label', 'style' => 'font-weight: bold']) }}
          {{ Form::file('fileBranchBannerImg', ['class' => 'form-control form-control-file']) }}
          <small class="form-text text-muted" id="fileHelp">Accepted file types: jpg, jpeg, png. This field is optional</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>  
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div> <!-- /Add branch modal -->

<div class="row">
    <div class="col-md-11">
        <span></span>
    </div>
    <div class="col-md-1">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus"></i>Add branch</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th scope="col">Branch ID</th>
                <th scope="col">Branch Name</th>
                <th scope="col">Branch Address</th>
                <th scope="col" class="text-center">Details</th>
              </tr>
            </thead>
            <tbody>
              @forelse($branches as $branch)
              <tr>
              <td scope="row">{{ $branch->int_id }}</td>
              <td>{{ $branch->str_branch_name }}</td>
              <td>{{ $branch->str_branch_address }}</td>
              <td class="text-center"><a href="/admin/maintenance/branch/{{ $branch->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span>View</a></td>
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
    $('a[href="/admin/maintenance/branches"]').addClass('active');
  });
</script>
@endsection
@endsection