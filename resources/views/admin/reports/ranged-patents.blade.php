@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-certificate"></i> Patent</h1>
  <p>An exclusive right granted for an invention</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Reports</li>
<li class="breadcrumb-item"><a href="{{ route('reports.patent') }}">Patented</a></li>
@endsection

@section('content')
<div class="tile tile-body">
  <h4 align="right">Reports as of today, {{ Carbon\Carbon::now()->format('M d, Y') }}</h4>
  <h5>Date Range</h5>
  <div class="row">
      <div class="col-md-4">
      <label>Start Date</label>
        <input class="form-control" name="dateStart" id="demoDate" type="text" placeholder="Select Date" value="{{ $dateStart }}" readonly>
      </div>
      <div class="col-md-4">
        <label>End Date</label>
        <input class="form-control" name="dateEnd" id="demoDate2" type="text" placeholder="Select Date" value="{{ $dateEnd }}" readonly>    
      </div>
      <div class="col-md-2">
        <br>
        <a href="{{ route('reports.patent') }}" class="btn btn-secondary">Back</a> 
      </div>
      <div class="col-md-2">
        <a role="button" target="_blank" href="/admin/reports/patents/{{ date('Y-m-d', strtotime($dateStart)) }}/
                {{date('Y-m-d', strtotime($dateEnd))}}/patents_pdf" class="btn btn-primary float-right">
          <i class="fa fa-file"> Generate all to PDF</i>
        </a>
      </div>
  </div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <ul class="nav nav-tabs">
              <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#patented">Patented</a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#on-process">On Process</a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#to-submit">To Submit</a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pending">Pending</a></li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="patented"><br>
              <a role="button" target="_blank" href="/admin/reports/patents/{{ date('Y-m-d', strtotime($dateStart)) }}/
                {{date('Y-m-d', strtotime($dateEnd))}}/patented_pdf" class="btn btn-primary float-right">
                <i class="fa fa-file"> Generate PDF</i>
              </a>
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th scope="col">Patent Project Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Date Requested</th>
                    <th scope="col">Date Patented</th>
                    <th scope="col">Applicant Name - Type</th>
                    <th scope="col">Department - College - Branch</th>
                    <th scope="col" class="text-center">Details</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($patents as $patent)
                    @if($patent->char_patent_status == 'patented' AND $patent->dtm_patented)
                    <tr>
                    <th scope="row">
                      <a href="/admin/reports/patented/{{ $patent->int_id }}">
                        {{ $patent->str_patent_project_title }}
                      </a>
                    </th>
                    <td scope="row">
                      <a href="/admin/maintenance/project-type/{{ $patent->int_project_type_id }}">
                        {{ $patent->projectType->char_project_type }}
                      </a>
                    </td>
                    <td scope="row">{{ $patent->created_at->format('m/d/Y g:i A') }}</td>
                    <td scope="row">{{ $patent->dtm_patented->format('m/d/Y g:i A') }}</td>
                    <td scope="row">{{ $patent->copyright->applicant->user->str_first_name }} {{ $patent->copyright->applicant->user->str_middle_name }} {{ $patent->copyright->applicant->user->str_last_name }} - {{ $patent->copyright->applicant->char_applicant_type }}</td>
                    <td scope="row"><a href="/admin/maintenance/department/{{ $patent->copyright->applicant->int_department_id }}">{{ $patent->copyright->applicant->department->char_department_code }}</a> - <a href="/admin/maintenance/college/{{ $patent->copyright->applicant->department->int_college_id }}">{{ $patent->copyright->applicant->department->college->char_college_code }}</a> - <a href="/admin/maintenance/branch/{{ $patent->copyright->applicant->department->college->int_branch_id }}">{{ $patent->copyright->applicant->department->college->branch->str_branch_name }}</a></td>
                    <td scope="row" class="text-center">
                      <a href="/admin/reports/patented/{{ $patent->int_id }}" role="button" class="btn btn-info">
                        <span class="fa fa-eye"></span> View
                      </a>
                    </td>
                    </tr>
                    @endif
                  @empty  
                    <div class="alert alert-warning">
                      There is no record yet.
                    </div>
                  @endforelse
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="on-process"><br>
              <a role="button" target="_blank" href="/admin/reports/patents/{{ date('Y-m-d', strtotime($dateStart)) }}/
                {{date('Y-m-d', strtotime($dateEnd))}}/on_process_patents_pdf" class="btn btn-primary float-right">
                <i class="fa fa-file"> Generate PDF</i>
              </a>
              <table class="table table-hover table-bordered" id="sampleTable2">
                <thead>
                  <tr>
                    <th scope="col">Patent Project Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Date Requested</th>
                    <th scope="col">Date On Process</th>
                    <th scope="col">Applicant Name - Type</th>
                    <th scope="col">College - Department - Branch</th>
                    <th scope="col" class="text-center">Details</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($patents as $patent)
                    @if($patent->char_patent_status == 'on process' AND $patent->dtm_on_process)
                    <tr>
                    <th scope="row">
                      <a href="/admin/transaction/patent/on-process/{{ $patent->int_id }}">
                        {{ $patent->str_patent_project_title }}
                      </a>
                    </th>
                    <td scope="row">
                      <a href="/admin/maintenance/project-type/{{ $patent->int_project_type_id }}">
                        {{ $patent->projectType->char_project_type }}
                      </a>
                    </td>
                    <td scope="row">{{ $patent->created_at->format('m/d/Y g:i A') }}</td>
                    <td scope="row">{{ $patent->dtm_on_process->format('m/d/Y g:i A') }}</td>
                    <td scope="row">{{ $patent->copyright->applicant->user->str_first_name }} {{ $patent->copyright->applicant->user->str_middle_name }} {{ $patent->copyright->applicant->user->str_last_name }} - {{ $patent->copyright->applicant->char_applicant_type }}</td>
                    <td scope="row"><a href="/admin/maintenance/department/{{ $patent->copyright->applicant->int_department_id }}">{{ $patent->copyright->applicant->department->char_department_code }}</a> - <a href="/admin/maintenance/college/{{ $patent->copyright->applicant->department->int_college_id }}">{{ $patent->copyright->applicant->department->college->char_college_code }}</a> - <a href="/admin/maintenance/branch/{{ $patent->copyright->applicant->department->college->int_branch_id }}">{{ $patent->copyright->applicant->department->college->branch->str_branch_name }}</a></td>
                    <td scope="row" class="text-center">
                      <a href="/admin/reports/patented/{{ $patent->int_id }}" role="button" class="btn btn-info">
                        <span class="fa fa-eye"></span> View
                      </a>
                    </td>
                    </tr>
                    @endif
                  @empty  
                    <div class="alert alert-warning">
                      There is no record yet.
                    </div>
                  @endforelse
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="to-submit"><br>
              <a role="button" target="_blank" href="/admin/reports/patents/{{ date('Y-m-d', strtotime($dateStart)) }}/
                {{date('Y-m-d', strtotime($dateEnd))}}/to_submit_patents_pdf" class="btn btn-primary float-right">
                <i class="fa fa-file"> Generate PDF</i>
              </a>
              <table class="table table-hover table-bordered" id="sampleTable3">
                <thead>
                  <tr>
                    <th scope="col">Patent Project Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Date Requested</th>
                    <th scope="col">Date To Submit</th>
                    <th scope="col">Applicant Name - Type</th>
                    <th scope="col">College - Department - Branch</th>
                    <th scope="col" class="text-center">Details</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($patents as $patent)
                    @if($patent->char_patent_status == 'to submit' AND $patent->dtm_to_submit)
                    <tr>
                    <th scope="row">
                      <a href="/admin/transaction/patent/to-submit/{{ $patent->int_id }}">
                        {{ $patent->str_patent_project_title }}
                      </a>
                    </th>
                    <td scope="row">
                      <a href="/admin/maintenance/project-type/{{ $patent->int_project_type_id }}">
                        {{ $patent->projectType->char_project_type }}
                      </a>
                    </td>
                    <td scope="row">{{ $patent->created_at->format('m/d/Y g:i A') }}</td>
                    <td scope="row">{{ $patent->dtm_to_submit->format('m/d/Y g:i A') }}</td>
                    <td scope="row">{{ $patent->copyright->applicant->user->str_first_name }} {{ $patent->copyright->applicant->user->str_middle_name }} {{ $patent->copyright->applicant->user->str_last_name }} - {{ $patent->copyright->applicant->char_applicant_type }}</td>
                    <td scope="row"><a href="/admin/maintenance/department/{{ $patent->copyright->applicant->int_department_id }}">{{ $patent->copyright->applicant->department->char_department_code }}</a> - <a href="/admin/maintenance/college/{{ $patent->copyright->applicant->department->int_college_id }}">{{ $patent->copyright->applicant->department->college->char_college_code }}</a> - <a href="/admin/maintenance/branch/{{ $patent->copyright->applicant->department->college->int_branch_id }}">{{ $patent->copyright->applicant->department->college->branch->str_branch_name }}</a>
                    </td>
                    <td scope="row" class="text-center"><a href="/admin/reports/patented/{{ $patent->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span> View</a></td>
                    </tr>
                    @endif
                  @empty  
                    <div class="alert alert-warning">
                      There is no record yet.
                    </div>
                  @endforelse
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="pending"><br>
              <a role="button" target="_blank" href="/admin/reports/patents/{{ date('Y-m-d', strtotime($dateStart)) }}/
                {{date('Y-m-d', strtotime($dateEnd))}}/pending_patents_pdf" class="btn btn-primary float-right">
                <i class="fa fa-file"> Generate PDF</i>
              </a>
              <table class="table table-hover table-bordered" id="sampleTable4">
                <thead>
                  <tr>
                    <th scope="col">Patent Project Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Date Requested</th>
                    <th scope="col">Applicant Name - Type</th>
                    <th scope="col">College - Department - Branch</th>
                    <th scope="col" class="text-center">Details</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($patents as $patent)
                    @if($patent->char_patent_status == 'pending' AND $patent->created_at)
                    <tr>
                    <th scope="row">
                      <a href="/admin/transaction/patent/pend-request/{{ $patent->int_id }}">
                        {{ $patent->str_patent_project_title }}
                      </a>
                    </th>
                    <td scope="row">
                      <a href="/admin/maintenance/project-type/{{ $patent->int_project_type_id }}">
                        {{ $patent->projectType->char_project_type }}
                      </a>
                    </td>
                    <td scope="row">{{ $patent->created_at->format('m/d/Y g:i A') }}</td>
                    <td scope="row">{{ $patent->copyright->applicant->user->str_first_name }} {{ $patent->copyright->applicant->user->str_middle_name }} {{ $patent->copyright->applicant->user->str_last_name }} - {{ $patent->copyright->applicant->char_applicant_type }}</td>
                    <td scope="row"><a href="/admin/maintenance/department/{{ $patent->copyright->applicant->int_department_id }}">{{ $patent->copyright->applicant->department->char_department_code }}</a> - <a href="/admin/maintenance/college/{{ $patent->copyright->applicant->department->int_college_id }}">{{ $patent->copyright->applicant->department->college->char_college_code }}</a> - <a href="/admin/maintenance/branch/{{ $patent->copyright->applicant->department->college->int_branch_id }}">{{ $patent->copyright->applicant->department->college->branch->str_branch_name }}</a>
                    </td>
                    <td scope="row" class="text-center"><a href="/admin/reports/patented/{{ $patent->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span> View</a></td>
                    </tr>
                    @endif
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
    $('a[href="/admin/reports/patent"]').addClass('active');
  });
</script>
@endsection