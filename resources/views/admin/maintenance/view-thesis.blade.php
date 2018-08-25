@extends('admin.layouts.app')

@section('pg-title')
@forelse($theses as $thesis)
<h1><i class="fa fa-file"></i> {{ $thesis->str_thesis_name }}</h1>
  <p>More about this project</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/theses">Projects</a></li>
<li class="breadcrumb-item"><a href="/admin/maintenance/thesis/{{ $thesis->int_id }}">{{ $thesis->str_thesis_name }}</a></li>
@endsection
@section('content')
<!-- Edit thesis modal-->
<div class="modal fade" id="modalLong" tabindex="-1" role="dialog" aria-labelledby="modalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="modalLongTitle">Edit Thesis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => ['Maintenance\ProjectController@updateThesis', $thesis->int_id, $thesis->int_department_id], 'method' => 'POST']) !!}
        <div class="form-group">
          {{ Form::label('lblThesisName', 'Thesis Name', ['style' => 'font-weight: bold']) }} 
          {{ Form::text('txtThesisName', $thesis->str_thesis_name, ['class' => 'form-control', 'placeholder' => 'Enter thesis name']) }}
        </div>
        <div class="form-group">
          {{Form::label('lblThesisDescription', 'Thesis Description', ['style' => 'font-weight: bold'])}}
          {{Form::textarea('txtAreaThesisDescription', $thesis->mdmTxt_thesis_description, ['id' => 'container-form-control article-ckeditor', 'class' => 'form-control', 'placeholder' => "Enter thesis description *optional field*", 'rows' => '4'])}}
        </div>
        <div class="form-group">
          {{Form::label('lblDepartmentCode', 'Assign thesis to', ['style' => 'font-weight: bold'])}}
        <select data-placeholder="PLaceholder itu" class="custom-select" name="slctDepartmentId">
          <option value="{{ $thesis->int_id }}" selected>{{ $thesis->char_department_code }} - {{ $thesis->str_department_name }} of ({{ $thesis->char_college_code }} - {{ $thesis->str_branch_name }})</option>
          @forelse($departments as $department)
          <option value="{{ $department->int_id }}">{{ $department->char_department_code }} - {{ $department->str_department_name }} of ({{ $department->char_college_code }} - {{ $department->str_branch_name }})</option>
          @empty
            <option>None</option>
          @endforelse
        </select>
        </div>
        <div class="modal-footer">
          {{Form::hidden('_method', 'PUT')}}
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>        
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div><!-- /Edit thesis modal -->

<div class="row">
  <div class="col-md-7">    
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
        <div class="row">
          <div class="col-md-10">
            <h4>Project details</h4>
          </div>
          <div class="col-md-2">
            <p><button type="button" class="btn btn-info mb-2 float-right" data-toggle="modal" data-target="#modalLong"><i class="fa fa-edit"></i>Edit</button></p>
          </div>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">{{ $thesis->str_thesis_name }}</h5>
          <h6 class="card-subtitle text-muted"><a href="/admin/maintenance/department/{{ $thesis->int_department_id }}">{{ $thesis->str_department_name }}</a></h6>
        </div>
        <div class="card-body">
          <p class="card-text"><strong>Description:</strong> {{ $thesis->mdmTxt_thesis_description }}</p>
          <p><strong>College: </strong><a href="/admin/maintenance/college/{{ $thesis->int_college_id }}">{{ $thesis->char_college_code }} - {{ $thesis->str_college_name }}</a></p>
          <p><strong>Branch: </strong><a href="/admin/maintenance/branch/{{ $thesis->int_branch_id }}">{{ $thesis->str_branch_name }}</a></p>
          @if($thesis->updated_at == $thesis->created_at)
          <p><strong>Last updated: </strong>Same as the date it was created</p>
          @else
          <p><strong>Last updated:</strong> {{ $thesis->updated_at }}</p>
          @endif
        </div>
        <div class="card-footer text-muted"><strong>Date added:</strong> {{ $thesis->created_at }}</div>
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="tile">
      <h3 class="tile-title">Related projects</h3>
      <div class="tile-body">
        <div class="bs-component">
          <div class="list-group">
            @forelse($otherTheses as $otherThesis)
            <a class="list-group-item list-group-item-action" href="/admin/maintenance/thesis/{{ $otherThesis->int_id }}/{{ $otherThesis->int_department_id }}">{{ $otherThesis->str_thesis_name }}</a>
            @empty
              <a class="list-group-item list-group-item-action disabled" href="#">There is no other thesis under same department.</a>
            @endforelse
          </div>
        </div>
      </div>
      <div class="tile-footer"><p class="text text-info">List of other theses under <strong><a href="/admin/maintenance/department/{{ $thesis->int_department_id }}">same</a></strong> department</p></div>
    </div>
  </div>
</div>  
@empty
  includes('admin.includes.page-error')
@endforelse
@section('pg-specific-js')
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-maintenance').addClass('is-expanded');
    $('a[href="/admin/maintenance/theses"]').addClass('active');
  });
</script>
@endsection
@endsection