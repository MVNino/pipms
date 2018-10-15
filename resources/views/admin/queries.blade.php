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
          <option value="1" selected>Branches with most copyrighted and patented works</option>
          <option value="2">Colleges with most copyrighted and patented works</option>
          <option value="3">Departments with most copyrighted and patented works</option>
          <option value="4">Most copyrightable type of works</option>
          <option value="5">Most patentable type of works</option>
          <option value="6">Most projects to comply</option>
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
                        <th class="text-center">Branch Name</th>
                        <th class="text-center">Total no. of Copyrighted works</th>
                      </tr>
                      
                    </thead>
                    <tbody>
                      <tr>
                        @foreach($copyrightstats as $copyright)
                          <td class="text-center">{{$copyright->str_branch_name}}</td>
                          <td class="text-center">{{$copyright->copyright_count_copyrighted}}</td>
                        @endforeach
                      </tr>
                      
                    </tbody>
                  </table>
                  <br/>
                  <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                      <tr>
                        <th class="text-center">Branch Name</th>
                        <th class="text-center">Total no. of Patented works</th>
                      </tr>
                      
                    </thead>
                    <tbody>
                      <tr>
                        @foreach($patentstats as $patent)
                          <td class="text-center">{{$patent->str_branch_name}}</td>
                          <td class="text-center">{{$patent->patent_count_patented}}</td>
                        @endforeach
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
                <div id="panel2" style="display: none;">
                  <table class="table table-hover table-bordered" id="sampleTable2">
                    <thead>
                      <tr>
                        <th class="text-center">College Name</th>
                        <th class="text-center">Branch Name</th>
                        <th class="text-center">Total no. of Copyrighted works</th>
                      </tr>
                    </thead>
                    <tbody> 
                    @foreach($copyrightstats as $copyright)            
                      <tr>
                          <th class="text-center">{{$copyright->char_college_code}}</th>
                          <th class="text-center">{{$copyright->str_branch_name}}</th>
                          <td class="text-center">{{$copyright->copyright_count_copyrighted}}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                  <br/>
                  <table class="table table-hover table-bordered" id="sampleTable2">
                    <thead>
                      <tr>
                        <th class="text-center">College Name</th>
                        <th class="text-center">Branch Name</th>
                        <th class="text-center">Total no. of Patented works</th>
                      </tr>
                    </thead>
                    <tbody> 
                    @foreach($patentstats as $patent)            
                      <tr>
                          <th class="text-center">{{$patent->char_college_code}}</th>
                          <th class="text-center">{{$patent->str_branch_name}}</th>
                          <td class="text-center">{{$patent->patent_count_patented}}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                
                <div id="panel3" style="display: none;">
                  <table class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center">Department Name</th>
                        <th class="text-center">College - Branch</th>
                        <th class="text-center">Total no. of Copyrighted works</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($copyrightstats as $copyright)                       
                      <tr>
                          <th class="text-center">{{$copyright->char_department_code}}</th>
                          <th class="text-center">{{$copyright->char_college_code}} - {{$copyright->str_branch_name}}</th>
                          <td class="text-center">{{$copyright->copyright_count_copyrighted}}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                  <br/>
                  <table class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center">Department Name</th>
                        <th class="text-center">College - Branch</th>
                        <th class="text-center">Total no. of Patented works</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($patentstats as $patent)                       
                      <tr>
                          <th class="text-center">{{$patent->char_department_code}}</th>
                          <th class="text-center">{{$patent->char_college_code}} - {{$patent->str_branch_name}}</th>
                          <td class="text-center">{{$patent->patent_count_patented}}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <div id="panel4" style="display: none;">
                  <table class="table table-hover table-bordered" id="sampleTable4">
                    <thead>
                      <tr>
                        <th class="text-center">Rank</th>
                        <th class="text-center">Copyrightable Work</th>
                        <th class="text-center">Total Number</th>
                        <th class="text-center">Rate</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                          <td class="text-center">1st</td>
                          <td class="text-center">Thesis</td>
                          <td class="text-center">625</td>
                          <td class="text-center">58%</td>
                      </tr>
                      <tr>
                          <td class="text-center">2nd</td>
                          <td class="text-center">Dramatic Works</td>
                          <td class="text-center">256</td>
                          <td class="text-center">26%</td>
                      </tr>
                      <tr>
                          <td class="text-center">3rd</td>
                          <td class="text-center">Musical Works</td>
                          <td class="text-center">156</td>
                          <td class="text-center">16%</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div id="panel5" style="display: none;">          
                  <table class="table table-hover table-bordered" id="sampleTable5">
                    <thead>
                      <tr>
                        <th class="text-center">Rank</th>
                        <th class="text-center">Copyrightable Work</th>
                        <th class="text-center">Total Number</th>
                        <th class="text-center">Rate</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                          <td class="text-center">1st</td>
                          <td class="text-center">Thesis</td>
                          <td class="text-center">625</td>
                          <td class="text-center">58%</td>
                      </tr>
                      <tr>
                          <td class="text-center">2nd</td>
                          <td class="text-center">Dramatic Works</td>
                          <td class="text-center">256</td>
                          <td class="text-center">26%</td>
                      </tr>
                      <tr>
                          <td class="text-center">3rd</td>
                          <td class="text-center">Musical Works</td>
                          <td class="text-center">156</td>
                          <td class="text-center">16%</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div id="panel6" style="display: none;">
                  <table class="table table-hover table-bordered" id="sampleTable6">
                    <thead>
                      <tr>
                        <th class="text-center">Rank</th>
                        <th class="text-center">Project</th>
                        <th class="text-center">Department - College - Branch</th>
                        <th class="text-center">Total Number</th>
                        <th class="text-center">Rate</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                          <td class="text-center"><b>1st</b></td>
                          <td class="text-center">Capstone</td>
                          <td class="text-center">BSIT - CCIS - PUP Main</td>
                          <td class="text-center">520</td>
                          <td class="text-center">64%</td>
                      </tr>
                      <tr>
                          <td class="text-center"><b>2nd</b></td>
                          <td class="text-center">SAD</td>
                          <td class="text-center">BSIT - CCIS - PUP Main</td>
                          <td class="text-center">260</td>
                          <td class="text-center">32%</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                
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
  $('#sampleTable2').DataTable();
  $('#sampleTable3').DataTable();
  $('#sampleTable4').DataTable();
  $('#sampleTable5').DataTable();
  $('#sampleTable6').DataTable();
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
      $('#panel7').css('display', 'none');
    }
    if(selectQuery == 7) {
      $('#panel1').css('display', 'none');
      $('#panel2').css('display', 'none');
      $('#panel3').css('display', 'none');
      $('#panel4').css('display', 'none');
      $('#panel5').css('display', 'none');
      $('#panel6').css('display', 'none');
      $('#panel7').css('display', 'block');
    }
  });
</script>
@endsection