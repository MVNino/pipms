@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-document"></i> Requirements</h1>
  <p>A listing of IPR Requirements</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="{{ route('maintenance.requirements') }}">Requirements</a></li>
@endsection

@section('content')
<!-- Add requirement modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Requirement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => 'Maintenance\RequirementController@addRequirement', 'method' => 'POST']) !!}
        @csrf
        <div class="form-group">
          {{Form::label('lblRequirement', 'Requirement', ['style' => 'font-weight: bold'])}}
          {{Form::textarea('txtAreaRequirement', '', ['class' => 'form-control', 'placeholder' => "Enter requirement", 'rows' => '4'])}}
        </div>
        <div class="row form-group justify-content-center">
          <div class="col-md-12 col-sm-12">
            <label><strong>Intellectual Property Rights Classification:</strong></label><br/>
            <div class="animated-radio-button form-check form-check-inline">
              <label class="form-check-label">
                <input class="form-check-input form-control" type="radio" name="radioIPR" value="C" required><span class="label-text">Copyright</span>
              </label>
            </div>
            <div class="animated-radio-button form-check form-check-inline">
              <label class="form-check-label">
                <input class="form-check-input form-control" type="radio" name="radioIPR" value="P" required><span class="label-text">Patent</span>
              </label>
            </div>
          </div>
        </div><br>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>  
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div> <!-- /Add requirement modal -->

<div class="row">
    <div class="col-md-11">
        <span></span>
    </div>
    <div class="col-md-1">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus"></i>Add requirement</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th scope="col">Requirement ID</th>
                <th scope="col">Requirement</th>
                <th scope="col">IPR Classification</th>
                <th scope="col" class="text-center">Details</th>
              </tr>
            </thead>
            <tbody>
              @forelse($requirements as $requirement)
              <tr>
              <td scope="row">{{ $requirement->int_id }}</td>
              <td>{{ $requirement->str_requirement }}</td>
              @if($requirement->char_ipr == 'P')
              <td>Patent</td>
              @else
              <td>Copyright</td>
              @endif
              <td class="text-center">
                <a href="/admin/maintenance/requirement/{{ $requirement->int_id }}" role="button" class="btn btn-info">
                  <span class="fa fa-eye"></span>View
                </a>
              </td>
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
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-maintenance').addClass('is-expanded');
    $('a[href="/admin/maintenance/requirements"]').addClass('active');
  });
</script>
@endsection