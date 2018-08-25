@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> {{ $branch->str_branch_name }}</h1>
  <p>More information about this branch</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/branches">Branches</a></li>
<li class="breadcrumb-item"><a href="/admin/maintenance/branch/{{ $branch->int_id }}">{{ $branch->str_branch_name }}</a></li>
@endsection
@section('content')
<!-- Edit branch modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Branch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => ['Maintenance\BranchController@updateBranch', $branch->int_id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
          {{Form::label('lblBranchName', 'Branch Name', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtBranchName', $branch->str_branch_name, ['class' => 'form-control', 'placeholder' => 'Enter branch name', 'required'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblBranchAddress', 'Branch Address', ['style' => 'font-weight: bold'])}} 
          {{Form::text('txtBranchAddress', $branch->str_branch_address, ['class' => 'form-control', 'placeholder' => 'Enter branch address', 'required'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblBranchDescription', 'Branch Description', ['style' => 'font-weight: bold'])}}
          {{Form::textarea('txtAreaBranchDescription', $branch->mdmTxt_branch_description, ['id' => 'container-form-control article-ckeditor', 'class' => 'form-control', 'placeholder' => "Enter branch description *optional field*", 'rows' => '4'])}}
        </div>
        <div class="form-group">
          {{ Form::label('lblBranchProfileImg', 'Branch Profile Image', ['class' => 'control-label', 'style' => 'font-weight: bold']) }}<br>
          <small>Current branch profile image: {{ $branch->str_branch_profile_image }}</small>
          {{ Form::file('fileBranchProfileImg', ['class' => 'form-control form-control-file']) }}
          <small class="form-text text-muted" id="fileHelp">Accepted file types: jpg, jpeg, png. This field is optional</small>
        </div>
        <div class="form-group">
          {{ Form::label('lblBranchBannerImg', 'Branch Banner Image', ['class' => 'control-label', 'style' => 'font-weight: bold']) }}<br>
          <small>Current branch banner image: {{ $branch->str_branch_banner_image }}</small>
          {{ Form::file('fileBranchBannerImg', ['class' => 'form-control form-control-file']) }}
          <small class="form-text text-muted" id="fileHelp">Accepted file types: jpg, jpeg, png. This field is optional</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Close</button>
          {{ Form::hidden('_method', 'PUT') }}
          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div> <!-- /Edit branch modal -->

<div class="row">
  <div class="col-md-7">    
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
        <div class="row">
          <div class="col-md-10">
            <h4>Branch details</h4>
          </div>
          <div class="col-md-2">
            <p><button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-edit"></i>Edit</button></p>
          </div> 
        </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">{{ $branch->str_branch_name }}</h5>
          <h6 class="card-subtitle text-muted">{{ $branch->str_branch_address }}</h6>
        </div>
        <div style="position: relative;">
        <a target="_blank" href="/storage/images/branch/banner/{{ $branch->str_branch_banner_image }}">
        <img style="height: 200px; width: 100%; display: block;" src="/storage/images/branch/banner/{{ $branch->str_branch_banner_image }}" alt="Branch banner image">
        </a>
          <a target="_blank" href="/storage/images/branch/profile/{{ $branch->str_branch_profile_image }}" style="position: absolute; bottom: -5%; left: 38%;">
              <img class="align-self-center rounded-circle mr-3" style="width:125px; height:125px;" alt="Branch profile image" src="/storage/images/branch/profile/{{ $branch->str_branch_profile_image }}">
          </a>
        </div>
        <div class="card-body">
          <p class="card-text"><strong>Description:</strong> {{ $branch->mdmTxt_branch_description }}</p>
          @if($branch->updated_at == $branch->created_at)
            <p><strong>Last updated at: </strong>Same as the date it was added.</p>
          @else
          <p><strong>Last updated at:</strong> {{ $branch->updated_at }}</p>
          @endif
        </div>
        <div class="card-footer text-muted"><strong>Date added:</strong> {{ $branch->created_at }}</div>
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
        <div class="row">
          <div class="col-md-12">
            <h4>Colleges</h4>
          </div> 
        </div>
        </div>
        <div class="card-body">
        <div class="bs-component">
          <div class="list-group">
            @forelse($branch->colleges as $college)
            <a class="list-group-item list-group-item-action" href="/admin/maintenance/college/{{ $college->int_id }}"><strong>{{ $college->char_college_code }}</strong> - {{ $college->str_college_name }}</a>
            @empty
            <a class="list-group-item list-group-item-action disabled" href="#">There is no assigned college/s for this branch yet.</a>
            @endforelse
          </div>
        </div>
        </div>
        <div class="card-footer text-muted"><p class="text text-info">List of <strong><a href="/admin/maintenance/colleges">colleges</a></strong> under <strong>{{ $branch->str_branch_name }}</strong> branch</p></div>
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