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
        <label><h5>Query Search</h5></label>
        <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-search"></i></span>
        </div>
        <select data-placeholder="Select query search" class="custom-select" name="query" id="selectQuery">
          <option selected></option>
          <option value="1">Branches with most copyrighted and patented works</option>
          <option value="2">Colleges with most copyrighted and patented works</option>
          <option value="3">Departments with most copyrighted and patented works</option>
          <option value="4">Most copyrightable type of works</option>
          <option value="5">Most patentable type of works</option>
          <option value="6">Applicants with appointment issue</option>
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
      </div>
  		<div class="tile-body">
          <div class="card">
              <div class="card-header" style="background-color: maroon;">
                  
              </div>
              <div class="card-body">
                <div id="panel1">
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
                <div id="panel2" style="display: none;">w</div>
                <div id="panel3" style="display: none;">o</div>
                <div id="panel4" style="display: none;">w</div>
                <div id="panel5" style="display: none;">n</div>
                <div id="panel6" style="display: none;">m</div>
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
<script>
  $('#selectQuery').on('change', function(){
    var selectQuery = ($('#selectQuery').val());
    if(selectQuery == 1) {
      $('#panel1').css('display', 'block');
      $('#panel2').css('display', 'none');
      $('#panel3').css('display', 'none');
      $('#panel4').css('display', 'none');
      $('#panel5').css('display', 'none');
      $('#panel6').css('display', 'none');
    }
    if(selectQuery == 2) {
      $('#panel1').css('display', 'none');
      $('#panel2').css('display', 'block');
      $('#panel3').css('display', 'none');
      $('#panel4').css('display', 'none');
      $('#panel5').css('display', 'none');
      $('#panel6').css('display', 'none');
    }
    if(selectQuery == 3) {
      $('#panel1').css('display', 'none');
      $('#panel2').css('display', 'none');
      $('#panel3').css('display', 'block');
      $('#panel4').css('display', 'none');
      $('#panel5').css('display', 'none');
      $('#panel6').css('display', 'none');
    }
    if(selectQuery == 4) {
      $('#panel1').css('display', 'none');
      $('#panel2').css('display', 'none');
      $('#panel3').css('display', 'none');
      $('#panel4').css('display', 'block');
      $('#panel5').css('display', 'none');
      $('#panel6').css('display', 'none');
    }
    if(selectQuery == 5) {
      $('#panel1').css('display', 'none');
      $('#panel2').css('display', 'none');
      $('#panel3').css('display', 'none');
      $('#panel4').css('display', 'none');
      $('#panel5').css('display', 'block');
      $('#panel6').css('display', 'none');
    }
    if(selectQuery == 6) {
      $('#panel1').css('display', 'none');
      $('#panel2').css('display', 'none');
      $('#panel3').css('display', 'none');
      $('#panel4').css('display', 'none');
      $('#panel5').css('display', 'none');
      $('#panel6').css('display', 'block');
    }
  });
</script>
@endsection