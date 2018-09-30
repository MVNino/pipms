@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-calendar"></i> Appointments Today</h1>
  <p>Today's schedule for submission of requirements for copyright registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Schedule</li>
<li class="breadcrumb-item"><a class="active" href="{{ route('admin.today') }}">Today</a></li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-8">		
			<div class="card">
				<div class="card-header bg-default">
					<h3>gege</h3>
				</div>
				<div class="card-body">
					@foreach($copyrights as $copyright)
					<div class="container">
			            <div class="row">
			              <div class="col-md-10">
			                <b>{{ $copyright->str_project_title }} - 
			                {{ $copyright->applicant->user->str_first_name }} 
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
			              <div class="col-md-2">
			                Time: {{ $copyright->dtm_schedule->format('g:i A') }}
			              </div>
			            </div><hr>  
			          </div>
					@endforeach
				</div>
				<div class="card-footer">
					hehehe
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="tile">
				<div class="tile-body">
					dsad
				</div>
			</div>
		</div>
	</div>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script>
  $(document).ready(function(){
    $('#li-schedule').addClass('is-expanded');
    $('a[href="{{ route('admin.today') }}"]').addClass('active');
  });
</script>
@endsection