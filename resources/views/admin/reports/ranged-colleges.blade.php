@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> College Reports</h1>
  <p>Copyright and Patent Statistics as Per College</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Reports</li>
<li class="breadcrumb-item"><a href="{{ route('reports.colleges') }}">Colleges</a></li>
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
          <a href="{{ route('reports.colleges') }}" class="btn btn-secondary">Back</a> 
        </div>
        <div class="col-md-2">
          <a role="button" target="_blank" href="/admin/reports/college/{{ date('Y-m-d', strtotime($dateStart)) }}/
                  {{date('Y-m-d', strtotime($dateEnd))}}/colleges_pdf" class="btn btn-primary float-right">
            <i class="fa fa-file"> Generate PDF</i>
          </a>
        </div>
    </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
        <ul class="nav nav-tabs">
          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#copyright">Copyright</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#patent">Patent</a></li>
        </ul>
      <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade active show" id="copyright">
            <br>
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th class="text-center">College</th>
                  <th class="text-center">Branch</th>
                  <th class="text-center">Authors</th>
                  <th colspan="5" class="text-center">Copyright</th>
                </tr>
                <tr>
                  <th scope="col"></th>
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
                @forelse($copyrightStats as $copyright)
                <tr>
                  <th class="text-center">
                    <a href="/admin/reports/college/{{ $copyright->college_id }}/range-date/{{ date('Y-m-d', strtotime($dateStart)) }}/{{ date('Y-m-d', strtotime($dateEnd)) }}">
                      {{ $copyright->char_college_code }}
                    </a>
                  </th>
                  <th class="text-center"> 
                    <a href="/admin/maintenance/branch/{{ $copyright->branch_id }}">
                      {{ $copyright->str_branch_name }}
                    </a>
                  </th>
                  <th class="text-center text-primary">
                    {{ $copyright->author_count }}
                  </th>
                  <td class="text-center">
                    {{ $copyright->copyright_count_pending }}
                  </td>
                  <td class="text-center">
                    {{ $copyright->copyright_count_to_submit }}
                    
                  </td>
                  <td class="text-center">
                    {{ $copyright->copyright_count_on_process }}
                  </td>
                  <td class="text-center text-danger">
                    {{ $copyright->copyright_count_to_conflict }}
                  </td>
                  <th class="text-center text-success">
                    {{ $copyright->copyright_count_copyrighted }}
                  </th>
                </tr>
                @empty
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="tab-pane fade" id="patent">
            <br>
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th class="text-center">College</th>
                <th class="text-center">Branch</th>
                <th class="text-center">Authors</th>
                <th colspan="5" class="text-center">Patent</th>
              </tr>
              <tr>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col">Pending</th>
                <th scope="col">To Submit</th>
                <th scope="col">On Process</th>
                <th scope="col" class="text-danger">Conflicts</th>
                <th scope="col" class="text-success">Patented</th>
              </tr>
            </thead>
            <tbody>
              @forelse($patentStats as $patent)
              <tr>
                <th class="text-center">
                  <a href="/admin/reports/college/{{ $patent->college_id }}/range-date/{{ date('Y-m-d', strtotime($dateStart)) }}/{{ date('Y-m-d', strtotime($dateEnd)) }}">
                    {{ $patent->char_college_code }}
                  </a>
                </th>
                <th class="text-center">
                  <a href="/admin/maintenance/branch/{{ $patent->branch_id }}">
                  {{ $patent->str_branch_name }}
                  </a>
                </th>
                <th class="text-center text-primary">
                  {{ $patent->author_count }}
                </th>
                <td class="text-center">
                  {{ $patent->patent_count_pending }}
                </td>
                <td class="text-center">
                  {{ $patent->patent_count_to_submit }} 
                </td>
                <td class="text-center">
                  {{ $patent->patent_count_on_process }}
                </td>
                <td class="text-center text-danger">
                  {{ $patent->patent_count_to_conflict }}
                </td>
                <th class="text-center text-success">
                  {{ $patent->patent_count_patented }}
                </th>
              </tr>
              @empty
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
    $('a[href="/admin/reports/colleges"]').addClass('active');
  });
</script>
@endsection