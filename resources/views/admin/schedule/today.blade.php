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
				<div class="card-header" style="color: maroon;">
					<h3>TODAY, {{ Carbon\Carbon::now()->format('F d') }}</h3>
				</div>
				<div class="card-body">
					@forelse($copyrights as $copyright)
					<div class="container">
			            <div class="row">
			              <div class="col-md-4">
			                <b>{{ $copyright->applicant->user->str_first_name }} 
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
			              <div class="col-md-5">
			              	Copyright: <a href="/admin/transaction/copyright/to-submit/{{ $copyright->int_id }}">{{ $copyright->str_project_title }}</a><br>
			              	@if($copyright->patent)
			              	Patent: <a href="/admin/transaction/patent/to-submit/{{ $copyright->patent->int_id }}">{{ $copyright->patent->str_patent_project_title }}</a>
			              	@endif 
			              </div>
			              <div class="col-md-3">
			                Time: {{ $copyright->dtm_schedule->format('g:i A') }}<br>
			                @if($copyright->dtm_schedule->diffInHours(Carbon\Carbon::now()) > 1)
			                	{{ $copyright->dtm_schedule->diffInHours(Carbon\Carbon::now()) }} hours from now
			                @else
			                	@if($copyright->dtm_schedule->diffInMinutes(Carbon\Carbon::now()) > 1)
				                	{{ $copyright->dtm_schedule->diffInMinutes(Carbon\Carbon::now()) }} minutes from now
			                	@else
			                		@if($copyright->dtm_schedule->diffInSeconds(Carbon\Carbon::now()) > 1)
				                	{{ $copyright->dtm_schedule->diffInSeconds(Carbon\Carbon::now()) }} seconds
				                	@else
				                	His appointment is now
				                	@endif
			                	@endif
			                @endif
			              </div>
			            </div><hr>  
			          </div>
					@empty
	              	<div class="alert alert-info">
    					There is no scheduled appointment for today.
    				</div>
					@endforelse
				</div>
				<div class="card-footer">
					<small style="color:maroon;">Have a nice day!</small>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header" style="background-color: maroon; color: #f3f3f3;">
					<h4>Status</h4>
				</div>
				<div class="card-body">
					<div class="card">
						<div class="card-body">
							Legend:<br> 
							<span class="badge badge-pill badge-default">Ongoing</span> 
							<span class="badge badge-pill badge-primary">Now</span> 
							<span class="badge badge-pill badge-success">Processed</span>
							<span class="badge badge-pill badge-info">To process</span>
							<span class="badge badge-pill badge-danger">Issue</span>
						</div>
					</div>
					@foreach($copyrights as $copyright)
					<div class="row">
						<div class="col-md-10">
							<a href="#">Copyright</a> | <a href="#">Patent</a> - 
							{{ $copyright->applicant->user->str_first_name }} 
							{{ $copyright->applicant->user->str_last_name }} 
						</div>
						<div class="col-md-2">
							<span class="badge badge-success badge-pill">
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							</span>
						</div>
					</div>
					@endforeach
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