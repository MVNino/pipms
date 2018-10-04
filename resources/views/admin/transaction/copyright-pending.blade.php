@extends('admin.layouts.app')

@section('pg-title')
<h1>Pending Requests for Copyright</h1>
  <p>A listing of projects which requests for copyright registration</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/copyrights/pend-request">Copyright Pending Requests</a></li>
@endsection

@section('content')
<div class="tile">
  <div class="tile-body">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#all">All</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#college">By College</a></li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active show" id="all">
          <table class="table table-hover table-bordered">
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
            @forelse($copyrights as $copyright)
            <tr>
              <td><b>{{ $copyright->str_project_title }}</b></td>
              <td><b>{{ $copyright->applicant->user->str_first_name }} {{ $copyright->applicant->user->str_last_name }}</b> - <b>{{ $copyright->applicant->char_applicant_type }}</b> </td>
              <td>{{ $copyright->applicant->department->char_department_code }} - {{ $copyright->applicant->department->college->char_college_code }} - {{ $copyright->applicant->department->college->branch->str_branch_name }}</td>
              <td>
                @if($copyright->created_at->diffInYears(Carbon\Carbon::now()) == 0)
                  @if($copyright->created_at->diffInDays(Carbon\Carbon::now()) <= 3)
                    {{ $copyright->created_at->format('M d - g:i A')}}
                  @else
                    {{ $copyright->created_at->format('F d')}}
                  @endif
                @else
                  {{ $copyright->created_at->format('M d, Y')}}
                @endif
              </td>
              <td class="text-center"><a href="/admin/transaction/copyright/pend-request/{{ $copyright->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span>View</a></td>
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
        <div class="tab-pane fade" id="college">
          <p>THIS IS BY BRANCH - COLLEGE Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit.</p>
        </div>
    </div>
  </div>
</div>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script>
  $(document).ready(function(){
    $('#li-transaction').addClass('is-expanded');
    $('a[href="/admin/transaction/copyrights/pend-request"]').addClass('active');
  });
</script>
<script>
  $(document).ready(function(){
    $('#li-copyright').addClass('');
    $('a[href="/admin/transaction/copyrights/pend-request"]').addClass('active');
  });
</script>
@endsection