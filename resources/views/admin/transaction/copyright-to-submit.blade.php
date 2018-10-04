@extends('admin.layouts.app')

@section('pg-title')
<h1>Submission of Requirements for Copyright Registration</h1>
  <p>A listing of projects that needs to submit requirements for copyright registration</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/copyrights/to-submit">To Submit Requirements</a></li>
@endsection

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="tile">
      <div class="row">
        <div class="col-md-9">
          <h4 class="tile-title text-muted">
            Today, {{ Carbon\Carbon::now()->format('F d') }}
          </h4>
        </div>
        <div class="col-md-3">
          <a href="{{ route('admin.today') }}" class="btn btn-primary">
            <i class="fa fa-eye"></i> Details
          </a>
        </div>
      </div>
      <div class="tile-body">
        @forelse($copyrights as $copyright)
          @if($copyright->dtm_schedule->day == Carbon\Carbon::now()->day)
          <div class="container">
            <div class="row">
              <div class="col-md-8">
                <b><a href="/admin/transaction/copyright/to-submit/{{ $copyright->int_id }}">
                  {{ $copyright->str_project_title }}
                  </a> - {{ $copyright->applicant->user->str_first_name }} 
                {{ $copyright->applicant->user->str_last_name }}</b> <br> 
                {{ $copyright->applicant->char_applicant_type }} 
                of <a href="/admin/maintenance/department/{{ $copyright->applicant->int_department_id }}">
                  {{ $copyright->applicant->department->char_department_code }}</a> 
                  (<a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">
                    {{ $copyright->applicant->department->college->char_college_code }}</a> - 
                    <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">
                      {{ $copyright->applicant->department->college->branch->str_branch_name }})
                    </a>
              </div>
              <div class="col-md-4">
                Time: {{ $copyright->dtm_schedule->format('g:i A') }}
              </div>
            </div><hr>  
          </div>
          @endif
        @empty
          <div class="alert alert-info">
            There is no scheduled appointment for today.
          </div>
        @endforelse
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="tile">
      <h4 class="tile-title text-muted">
        Tomorrow, {{ Carbon\Carbon::now()->addDay()->format('F d') }}
      </h4>
      <div class="tile-body">
        @forelse($copyrights as $copyright)
          @if($copyright->dtm_schedule->day == Carbon\Carbon::now()->addDay()->day)
          <div class="container">      
            <div class="row">
              <div class="col-md-10">
                <b><a href="/admin/transaction/copyright/to-submit/{{ $copyright->int_id }}">
                  {{ $copyright->str_project_title }}
                  </a> - {{ $copyright->applicant->user->str_first_name }} 
                {{ $copyright->applicant->user->str_last_name }}</b><br> 
                {{ $copyright->applicant->char_applicant_type }} 
                of <a href="/admin/maintenance/department/{{ $copyright->applicant->int_department_id }}">
                  {{ $copyright->applicant->department->char_department_code }}</a> 
                  (<a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">
                    {{ $copyright->applicant->department->college->char_college_code }}</a> - 
                    <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">
                      {{ $copyright->applicant->department->college->branch->str_branch_name }})
                    </a>
              </div>
              <div class="col-md-2">
                Time: {{ $copyright->dtm_schedule->format('g:i A') }}
              </div>
            </div><hr>  
          </div>
          @endif
        @empty
          <div class="alert alert-info">
            There is no scheduled appointment for today.
          </div>
        @endforelse
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="tile">
      <h4 class="tile-title text-muted">
        {{ Carbon\Carbon::now()->addDays(2)->format('l, F d') }}
      </h4>
      <div class="tile-body">
        @forelse($copyrights as $copyright)
          @if($copyright->dtm_schedule->day == Carbon\Carbon::now()->addDays(2)->day)
          <div class="container">      
            <div class="row">
              <div class="col-md-10">
                <b><a href="/admin/transaction/copyright/to-submit/{{ $copyright->int_id }}">
                  {{ $copyright->str_project_title }}
                  </a> - 
                {{ $copyright->applicant->user->str_first_name }} 
                {{ $copyright->applicant->user->str_last_name }}</b><br> 
                {{ $copyright->applicant->char_applicant_type }} 
                of <a href="/admin/maintenance/department/{{ $copyright->applicant->int_department_id }}">
                  {{ $copyright->applicant->department->char_department_code }}</a> 
                  (<a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">
                    {{ $copyright->applicant->department->college->char_college_code }}</a> - 
                    <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">
                      {{ $copyright->applicant->department->college->branch->str_branch_name }})
                    </a>
              </div>
              <div class="col-md-2">
                Time: {{ $copyright->dtm_schedule->format('g:i A') }}
              </div>
            </div><hr>
          </div>
          @endif
        @empty
          <div class="alert alert-info">
            There is no scheduled appointment for today.
          </div>
        @endforelse
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="tile">
      <h4 class="tile-title text-muted">{{ Carbon\Carbon::now()->addDays(3)->format('l, F d') }}</h4>
      <div class="tile-body">
        @forelse($copyrights as $copyright)
          @if($copyright->dtm_schedule->day == Carbon\Carbon::now()->addDays(3)->day)
          <div class="container">      
            <div class="row">
              <div class="col-md-10">
                <b><a href="/admin/transaction/copyright/to-submit/{{ $copyright->int_id }}">
                  {{ $copyright->str_project_title }}
                  </a> - 
                {{ $copyright->applicant->user->str_first_name }} 
                {{ $copyright->applicant->user->str_last_name }}</b><br> 
                {{ $copyright->applicant->char_applicant_type }} 
                of <a href="/admin/maintenance/department/{{ $copyright->applicant->int_department_id }}">
                  {{ $copyright->applicant->department->char_department_code }}</a> 
                  (<a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">
                    {{ $copyright->applicant->department->college->char_college_code }}</a> - 
                    <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">
                      {{ $copyright->applicant->department->college->branch->str_branch_name }})
                    </a>
              </div>
              <div class="col-md-2">
                Time: {{ $copyright->dtm_schedule->format('g:i A') }}
              </div>
            </div><hr>
          </div>
          @endif
        @empty
          <div class="alert alert-info">
            There is no scheduled appointment for today.
          </div>
        @endforelse
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<div class ="tile">
  <h3 class="tile-title text-muted">Future appointments</h3>
  <div class="tile-body">
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>Scheduled Date</th>
          <th>Project/Work Title</th>
          <th>Applicant - Type</th>
          <th>Department-College-Branch</th>
        </tr>
      </thead>
      <tbody>
        @forelse($copyrights as $copyright)
          @if($copyright->dtm_schedule->diffInDays(Carbon\Carbon::now()) >= 4)
          <tr>
            <td>{{ $copyright->dtm_schedule->format('F d') }}</td>
            <td><b><a href="/admin/transaction/copyright/to-submit/{{ $copyright->int_id }}">
                  {{ $copyright->str_project_title }}
                  </a>
                </b>
            </td>
            <td>
              <b>{{ $copyright->applicant->user->str_first_name }} 
              {{ $copyright->applicant->user->str_last_name }} - 
              {{ $copyright->applicant->char_applicant_type }}
              </b>
            </td>
            <td>
              <a href="/admin/maintenance/department/{{ $copyright->applicant->int_department_id }}">
              {{ $copyright->applicant->department->char_department_code }}</a> 
              (<a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">
                {{ $copyright->applicant->department->college->char_college_code }}</a> - 
                <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">
                  {{ $copyright->applicant->department->college->branch->str_branch_name }})
                </a>
            </td>
          </tr> 
          @endif
        @empty
          <div class="alert alert-info">
            There is no scheduled future appointment/s.
          </div>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="tile-footer">
    <div class="text-right"><span class="text-muted mr-2">Showing 1-15 out of 60</span>
      <div class="btn-group">
        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-chevron-left"></i></button>
        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-chevron-right"></i></button>
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
    $('a[href="/admin/transaction/copyrights/to-submit"]').addClass('active');
  });
</script>
@endsection