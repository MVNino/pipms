@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-history"></i> Queries</h1>
  <p>System Queries</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Queries</li>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="tile">
            <div class="tile-header">
                
            </div>
			<div class="tile-body">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th class="text-center">Branch</th>
                      <th class="text-center">Authors</th>
                      <th colspan="5" class="text-center">Copyright</th>
                    </tr>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col"></th>
                      <th scope="col">Pending</th>
                      <th scope="col">To Submit</th>
                      <th scope="col">On Process</th>
                      <th scope="col" class="text-danger">Conflicts</th>
                      <th scope="col" class="text-success">Copyrighted</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                  </tbody>
                </table>
			</div>
			<div class="tile-footer">
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