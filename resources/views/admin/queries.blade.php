@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-history"></i> Queries</h1>
  <p>System Queries</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item"><a href="{{ route('queries') }}">Queries</a></li>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="tile tile-body">
      <div class="form-group">
        <label>Query Search</label>
        <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-search"></i></span>
        </div>
        <select data-placeholder="Select department" class="custom-select" name="slctDepartmentId">
          <option selected></option>
          <option></option>
        </select>
        </div>
      </div>  
    </div>
  </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="tile">
      <div class="tile-header">
          <h3>Queries</h3>
      </div>
  		<div class="tile-body">
          <div class="card">
              <div class="card-header" style="background-color: maroon;">
                  
              </div>
              <div class="card-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th class="text-center">Branch</th>
                    <th class="text-center">Authors</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                      <td></td>
                      <td></td>
                  </tr>
                </tbody>
              </table>
              </div>
          </div>
      </div>
		</div>
	</div>
</div>
@endsection

@section('pg-specific-js')
{{-- Page Specific JavaScript --}}
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
  $('#sampleTable').DataTable();
</script>
@endsection