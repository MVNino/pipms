@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> Branch Report</h1>
  <p>Form of intellectual property protection</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Reports</li>
<li class="breadcrumb-item"><a href="{{ route('reports.branch') }}">Copyright</a></li>
@endsection

@section('content')
<div class="tile tile-body">
    <h5>Date Range</h5>
	<div class="row">
	    <div class="col-md-4">
	        <label>Start Date</label>
			<input class="form-control" name="dateStart" id="demoDate" type="text" placeholder="Select Date">
	    </div>
	    <div class="col-md-4">
	        <label>End Date</label>
	        <input class="form-control" name="dateEnd" id="demoDate2" type="text" placeholder="Select Date">	  
	    </div>
	    <div class="col-md-2"></div>
	    <div class="col-md-2">
	      <!-- Button trigger modal -->
	      <button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-file"></i>Print PDF</button>
	    </div>
	</div>
</div>

<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>Branch</th>
                <th colspan="5" class="text-center">Copyright</th>
                <th colspan="5" class="text-center">Patent</th>
              </tr>
              <tr>
                <th scope="col"></th>
                <th scope="col">Pending</th>
                <th scope="col">To Submit</th>
                <th scope="col">On Process</th>
                <th scope="col" class="text-danger">Conflicts</th>
                <th scope="col" class="text-success">Copyrighted</th>
                <th scope="col">Pending</th>
                <th scope="col">To Submit</th>
                <th scope="col">On Process</th>
                <th scope="col" class="text-danger">Conflicts</th>
                <th scope="col" class="text-success">Patented</th>
              </tr>
            </thead>
            <tbody>
              @foreach($branches as $branch)
            	<tr>
            		<th class="text-center">{{ $branch->str_branch_name }}</th>
            		<td class="text-center">62</td>
            		<td class="text-center">65</td>
            		<td class="text-center">64</td>
            		<td class="text-center text-danger">36</td>
            		<th class="text-center text-success">78</th>
            		<td class="text-center">145</td>
            		<td class="text-center">65</td>
            		<td class="text-center">32</td>
            		<td class="text-center text-danger">34</td>
            		<th class="text-center text-success">78</th>
            	</tr>
              @endforeach
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
<script type="text/javascript">
  $('#sampleTable').DataTable();
</script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/bootstrap-datepicker.min.js') }}"></script>
<script>
$('#demoDate').datepicker({
  format: "yyyy-mm-dd",
  autoclose: true,
  todayHighlight: true
});
$('#demoDate2').datepicker({
  format: "yyyy-mm-dd",
  autoclose: true,
  todayHighlight: true
});
</script>
<script>
  $(document).ready(function(){
    $('#li-reports').addClass('is-expanded');
    $('a[href="/admin/reports/branch"]').addClass('active');
  });
</script>
@endsection