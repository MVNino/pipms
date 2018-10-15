@extends('admin.layouts.app')

@section('pg-title')
<h1>Pending Requests for Patent</h1>
  <p>A listing of projects which requests for patent registration</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/patents/pend-request">Patents Pending Requests</a></li>
@endsection

@section('content')
<div class="tile">
  <div class="tile-body">
    <table class="table table-hover table-bordered" id="sampleTable">
      <thead>
        <tr>
          <th>Project/Work Title</th>
          <th>Applicant - Type</th>
          <th>Department-College-Branch</th>
          <th>Date Requested</th>
          <th class="text-center">View more details</th>
        </tr>
      </thead>
      <tbody>
      @forelse($patents as $patent)
      <tr>
        <td><b>{{ $patent->str_patent_project_title }}</b></td>
        <td><b>
          <a href="/admin/reports/author/{{ $patent->copyright->applicant->user->id }}">
            {{ $patent->copyright->applicant->user->str_first_name }} 
            {{ $patent->copyright->applicant->user->str_last_name }}</a></b> - 
            <b>{{ $patent->copyright->applicant->char_applicant_type }}</b> 
        </td>
        <td>
          <a href="/admin/maintenance/department/{{ $patent->copyright->applicant->department->int_id }}">
            {{ $patent->copyright->applicant->department->char_department_code }}
          </a> - 
          <a href="/admin/maintenance/college/{{ $patent->copyright->applicant->department->int_college_id }}">
            {{ $patent->copyright->applicant->department->college->char_college_code }} 
          </a> - 
          <a href="/admin/maintenance/branch/{{ $patent->copyright->applicant->department->college->int_branch_id }}">
            {{ $patent->copyright->applicant->department->college->branch->str_branch_name }}
          </a>
        </td>
        <td>
          @if($patent->created_at->diffInYears(Carbon\Carbon::now()) == 0)
            @if($patent->created_at->diffInDays(Carbon\Carbon::now()) <= 3)
              {{ $patent->created_at->format('M d - g:i A')}}
            @else
              {{ $patent->created_at->format('F d')}}
            @endif
          @else
            {{ $patent->created_at->format('M d, Y')}}
          @endif
        </td>
        <td class="text-center"><a href="/admin/transaction/patent/pend-request/{{ $patent->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span>View</a></td>
      </tr>
      @empty
        <div class="alert alert-warning">
          There is no record yet.
        </div>
      @endforelse
      </tbody>
      <tfoot>

      </tfoot>
    </table>
  </div>
</div>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-transaction').addClass('is-expanded');
    $('a[href="/admin/transaction/patents/pend-request"]').addClass('active');
  });
</script>
@endsection