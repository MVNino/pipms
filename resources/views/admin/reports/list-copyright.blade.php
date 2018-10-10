@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-copyright"></i> Copyright Report</h1>
  <p>Form of intellectual property protection</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Reports</li>
<li class="breadcrumb-item"><a href="{{ route('reports.copyright') }}">Copyright</a></li>
@endsection
@section('content')
<div class="tile tile-body">
  <h4 align="right">Reports as of today, {{ Carbon\Carbon::now()->format('M d, Y') }}</h4>
  <h5>Date Range</h5>
  <div class="row">
      <div class="col-md-4">
      <label>Start Date</label>
      <input class="form-control" name="dateStart" id="demoDate" type="text" placeholder="Select Date">
      </div>
      <div class="col-md-4">
          <label>End Date</label>
          <input class="form-control" name="dateEnd" id="demoDate2" type="text" placeholder="Select Date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">    
      </div>
      <div class="col-md-2">
        <br>
        <button class="btn btn-default"><i class="fa fa-search"></i>Search</button> 
      </div>
      <div class="col-md-2">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-file"></i>Generate PDF</button>
      </div>
  </div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <ul class="nav nav-tabs">
              <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#copyrighted">Copyrighted</a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#on-process">On Process</a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#to-submit">To Submit</a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pending">Pending</a></li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="copyrighted"><br>
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th scope="col">Project Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Date Copyrighted</th>
                    <th scope="col">Applicant Name - Type</th>
                    <th scope="col">Department - College - Branch</th>
                    <th scope="col" class="text-center">Details</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($copyrights as $copyright)
                    @if($copyright->char_copyright_status == 'copyrighted' AND $copyright->dtm_copyrighted)
                    <tr>
                    <th scope="row">
                      <a href="/admin/reports/copyrighted/{{ $copyright->int_id }}">
                        {{ $copyright->str_project_title }}
                      </a>
                    </th>
                    <td scope="row">
                      <a href="/admin/maintenance/project-type/{{ $copyright->int_project_type_id }}">
                        {{ $copyright->projectType->char_project_type }}
                      </a>
                    </td>
                    <td scope="row">{{ $copyright->dtm_copyrighted->format('m/d/Y g:i A') }}</td>
                    <td scope="row">{{ $copyright->applicant->user->str_first_name }} {{ $copyright->applicant->user->str_middle_name }} {{ $copyright->applicant->user->str_last_name }} - {{ $copyright->applicant->char_applicant_type }}</td>
                    <td scope="row"><a href="/admin/maintenance/department/{{ $copyright->applicant->int_department_id }}">{{ $copyright->applicant->department->char_department_code }}</a> - <a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">{{ $copyright->applicant->department->college->char_college_code }}</a> - <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">{{ $copyright->applicant->department->college->branch->str_branch_name }}</a>
                    </td>
                    <td scope="row" class="text-center"><a href="/admin/reports/copyrighted/{{ $copyright->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span> View</a></td>
                    </tr>
                    @endif
                  @empty  
                    <div class="alert alert-warning">
                      There is no record yet.
                    </div>
                  @endforelse
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="on-process"><br>
              <table class="table table-hover table-bordered" id="sampleTable2">
                <thead>
                  <tr>
                    <th scope="col">Project Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Date On Process</th>
                    <th scope="col">Applicant Name - Type</th>
                    <th scope="col">Department - College - Branch</th>
                    <th scope="col" class="text-center">Details</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($copyrights as $copyright)
                    @if($copyright->char_copyright_status == 'on process' AND $copyright->dtm_on_process)
                    <tr>
                    <th scope="row">
                      <a href="/admin/reports/copyrighted/{{ $copyright->int_id }}">
                        {{ $copyright->str_project_title }}
                      </a>
                    </th>
                    <td scope="row">
                      <a href="/admin/maintenance/project-type/{{ $copyright->int_project_type_id }}">
                        {{ $copyright->projectType->char_project_type }}
                      </a>
                    </td> 
                    <td scope="row">{{ $copyright->dtm_on_process->format('m/d/Y g:i A') }}</td>
                    <td scope="row">{{ $copyright->applicant->user->str_first_name }} {{ $copyright->applicant->user->str_middle_name }} {{ $copyright->applicant->user->str_last_name }} - {{ $copyright->applicant->char_applicant_type }}</td>
                    <td scope="row"><a href="/admin/maintenance/department/{{ $copyright->applicant->int_department_id }}">{{ $copyright->applicant->department->char_department_code }}</a> - <a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">{{ $copyright->applicant->department->college->char_college_code }}</a> - <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">{{ $copyright->applicant->department->college->branch->str_branch_name }}</a>
                    </td>
                    <td scope="row" class="text-center"><a href="/admin/reports/copyrighted/{{ $copyright->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span> View</a></td>
                    </tr>
                    @endif
                  @empty  
                    <div class="alert alert-warning">
                      There is no record yet.
                    </div>
                  @endforelse
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="to-submit"><br>
              <table class="table table-hover table-bordered" id="sampleTable3">
                <thead>
                  <tr>
                    <th scope="col">Project Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Date To Submit</th>
                    <th scope="col">Applicant Name - Type</th>
                    <th scope="col">Department - College - Branch</th>
                    <th scope="col" class="text-center">Details</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($copyrights as $copyright)
                    @if($copyright->char_copyright_status == 'to submit' AND $copyright->dtm_to_submit)
                    <tr>
                    <th scope="row">
                      <a href="/admin/reports/copyrighted/{{ $copyright->int_id }}">
                        {{ $copyright->str_project_title }}
                      </a>
                    </th>
                    <td scope="row">
                      <a href="/admin/maintenance/project-type/{{ $copyright->int_project_type_id }}">
                        {{ $copyright->projectType->char_project_type }}
                      </a>
                    </td>
                    <td scope="row">{{ $copyright->dtm_to_submit->format('m/d/Y g:i A') }}</td>
                    <td scope="row">{{ $copyright->applicant->user->str_first_name }} {{ $copyright->applicant->user->str_middle_name }} {{ $copyright->applicant->user->str_last_name }} - {{ $copyright->applicant->char_applicant_type }}</td>
                    <td scope="row"><a href="/admin/maintenance/department/{{ $copyright->applicant->int_department_id }}">{{ $copyright->applicant->department->char_department_code }}</a> - <a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">{{ $copyright->applicant->department->college->char_college_code }}</a> - <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">{{ $copyright->applicant->department->college->branch->str_branch_name }}</a>
                    </td>
                    <td scope="row" class="text-center"><a href="/admin/reports/copyrighted/{{ $copyright->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span> View</a></td>
                    </tr>
                    @endif
                  @empty  
                    <div class="alert alert-warning">
                      There is no record yet.
                    </div>
                  @endforelse
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="pending"><br>
              <table class="table table-hover table-bordered" id="sampleTable4">
                <thead>
                  <tr>
                    <th scope="col">Project Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Date requested</th>
                    <th scope="col">Applicant Name - Type</th>
                    <th scope="col">Department - College - Branch</th>
                    <th scope="col" class="text-center">Details</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($copyrights as $copyright)
                    @if($copyright->char_copyright_status == 'pending' AND $copyright->created_at)
                    <tr>
                    <th scope="row">
                      <a href="/admin/reports/copyrighted/{{ $copyright->int_id }}">
                        {{ $copyright->str_project_title }}
                      </a>
                    </th>
                    <td scope="row">
                      <a href="/admin/maintenance/project-type/{{ $copyright->int_project_type_id }}">
                        {{ $copyright->projectType->char_project_type }}
                      </a>
                    </td>
                    <td scope="row">{{ $copyright->created_at->format('m/d/Y g:i A') }}</td>
                    <td scope="row">{{ $copyright->applicant->user->str_first_name }} {{ $copyright->applicant->user->str_middle_name }} {{ $copyright->applicant->user->str_last_name }} - {{ $copyright->applicant->char_applicant_type }}</td>
                    <td scope="row"><a href="/admin/maintenance/department/{{ $copyright->applicant->int_department_id }}">{{ $copyright->applicant->department->char_department_code }}</a> - <a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">{{ $copyright->applicant->department->college->char_college_code }}</a> - <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">{{ $copyright->applicant->department->college->branch->str_branch_name }}</a>
                    </td>
                    <td scope="row" class="text-center"><a href="/admin/reports/copyrighted/{{ $copyright->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span> View</a></td>
                    </tr>
                    @endif
                  @empty  
                    <div class="alert alert-warning">
                      There is no record yet.
                    </div>
                  @endforelse
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
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
  $('#sampleTable').DataTable();
  $('#sampleTable2').DataTable();
  $('#sampleTable3').DataTable();
  $('#sampleTable4').DataTable();
</script>
<script>
  $(document).ready(function(){
    $('#li-reports').addClass('is-expanded');
    $('a[href="/admin/reports/copyright"]').addClass('active');
  });
</script>
@endsection