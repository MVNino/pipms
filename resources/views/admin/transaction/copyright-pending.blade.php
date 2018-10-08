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
              <td><a href="/admin/reports/author/{{ $copyright->applicant->user->id }}"><b>{{ $copyright->applicant->user->str_first_name }} {{ $copyright->applicant->user->str_last_name }}</b></a> - <b>{{ $copyright->applicant->char_applicant_type }}</b> </td>
              <td><a href="/admin/maintenance/department/{{ $copyright->applicant->department->int_id }}">{{ $copyright->applicant->department->char_department_code }}</a> - <a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">{{ $copyright->applicant->department->college->char_college_code }}</a> - <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">{{ $copyright->applicant->department->college->branch->str_branch_name }}</td>
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
          <div class="row">
            @foreach($groupedCopyrights as $copyright)
            <div class="col-md-6">
              <div class="tile">
                <div class="row">
                  <div class="col-md-9">
                    <h4 class="tile-title text-muted">
                      <a href="/admin/transaction/copyrights/pend-request/id/college">
                        {{ $copyright->char_college_code }}
                      </a>
                    </h4>
                  </div>
                  <div class="col-md-3">
                    <a href="{{ route('admin.today') }}" class="btn btn-primary">
                      <i class="fa fa-eye"></i>Set Batch
                    </a>
                  </div>
                </div>
                <div class="tile-body">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-8">
                          <b>
                            <a href="/admin/transaction/copyright/pend-request/{{ $copyright->int_id }}">
                            {{ $copyright->str_project_title }}
                            </a> - Marlon Niño
                          </b>(Student)
                        </div>
                        <div class="col-md-4">
                          Oct 7, 2:30 PM
                        </div> 
                    </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
            {{-- @foreach($collegeGroup as $copyright)
              <div class="tile tile-body">
                {{ $copyright }}
              </div>
            @endforeach --}}
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