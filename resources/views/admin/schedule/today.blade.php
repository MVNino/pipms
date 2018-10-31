@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-calendar"></i> Appointments Today</h1>
  <p>Today's schedule for submission of requirements for copyright and patent registration</p>
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
				<h3>TODAY: {{ Carbon\Carbon::now()->format('jS \of F Y') }}</h3>
			</div>
			<div class="card-body">
				<ul class="nav nav-tabs">
		          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#copyright">Copyright</a></li>
		          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#patent">Patent</a></li>
		        </ul>
				<div class="tab-content" id="myTabContent">
				  <div class="tab-pane fade active show" id="copyright">

				  <div class="table-responsive">
	              <table class="table table-hover table-bordered" id="sampleTable">
	                <thead>
	                  <tr>
	                    <th class="text-center">Author - Type</th>
	                    <th class="text-center">Department - College - Branch</th>
	                    <th class="text-center">Work Title</th>
	                    <th class="text-center">Schedule</th>
	                    <th class="text-center">Cancel Application</th>
	                    <th class="text-center">Check Requirements</th>
	                  </tr>
	                </thead>
	                <tbody>
	                	@forelse($copyrights as $copyright)
	                	<tr>
	                		<td class="text-center">
	                			<b>{{ $copyright->applicant->user->str_first_name }} 
					                {{ $copyright->applicant->user->str_last_name }}
					            </b> - {{ $copyright->applicant->char_applicant_type }}
			            	</td>
	                		<td class="text-center">
	                			<a href="/admin/maintenance/department/{{ $copyright->applicant->int_department_id }}">
			                  {{ $copyright->applicant->department->char_department_code }}</a> 
			                  <a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">
			                    {{ $copyright->applicant->department->college->char_college_code }}</a> - 
			                    <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">
			                      {{ $copyright->applicant->department->college->branch->str_branch_name }}</a>
	                		</td>
	                		<td class="text-center">
				              	Copyright: <a href="/admin/transaction/copyright/to-submit/{{ $copyright->int_id }}">{{ $copyright->str_project_title }}</a><br>
				              	@if($copyright->patent)
				              		@if($copyright->patent->char_patent_status == 'to submit')
				              			@if(date('Y-m-d', strtotime($copyright->patent->dtm_schedule)) == date('Y-m-d', strtotime(now())))
							              	Patent: <a href="/admin/transaction/patent/to-submit/{{ $copyright->patent->int_id }}">{{ $copyright->patent->str_patent_project_title }}</a>
				              			@endif
				              		@endif
				              	@endif
	                		</td>
	                		<td class="text-center">
				              	<b>{{ date('g:i A', strtotime($copyright->dtm_schedule))}}<br></b>
				              	@if($copyright->char_copyright_status == 'to submit/conflict')
				              	<small class="text-muted">(Rescheduled)</small>
				              	@endif
				                @if($copyright->patent)
				              		@if($copyright->patent->char_patent_status == 'to submit')
				              			@if($copyright->patent->dtm_schedule->diffInDays(Carbon\Carbon::now()) == 0)
				              				@if($copyright->patent->dtm_schedule == $copyright->dtm_schedule)
							        			{{-- Show nothing --}}
							        		@else
							        		<b>{{ $copyright->patent->dtm_schedule->format('g:i A') }}</b>
							        		@endif
				              			@endif
				              		@endif
				              	@endif
	                		</td>
	                		<td class="text-center">
			              		<a href="/admin/schedule-today/{{ $copyright->int_id }}/copyright/conflict" role="button" class="btn btn-circle btn-danger">
			              			<i class="fa fa-times"></i>
			              		</a>
	                		</td>
	                		<td class="text-center">
	                			<a role="button" class="btn btn-circle btn-info" href="/admin/transaction/copyright/to-submit/{{ $copyright->int_id }}">
	                				<i class="fa fa-check"></i>
	                			</a>
	                		</td>
	                	</tr>
	                	@empty
	                	<div class="alert alert-warning">There is no scheduled appointment for today.</div>
	                	@endforelse
	                </tbody>
	              </table>
				  </div>
				  </div>
				  <div class="tab-pane fade" id="patent">
					<div class="table-responsive">
		              <table class="table table-hover table-bordered" id="sampleTable">
			                <thead>
			                  <tr>
			                    <th class="text-center">Author - Type</th>
			                    <th class="text-center">Department - College - Branch</th>
			                    <th class="text-center">Work Title</th>
			                    <th class="text-center">Schedule</th>
			                    <th class="text-center">Cancel Application</th>
			                    <th class="text-center">Check Requirements</th>
			                  </tr>
			                </thead>
			                <tbody>
			                	@forelse($patents as $patent)
			                	<tr>
			                		<td class="text-center">
			                			<b>{{ $patent->copyright->applicant->user->str_first_name }} 
						                {{ $patent->copyright->applicant->user->str_last_name }}</b> -  
						                {{ $patent->copyright->applicant->char_applicant_type }}
			                		</td>
			                		<td class="text-center">
			                			<a href="/admin/maintenance/department/{{ $patent->copyright->applicant->int_department_id }}">
						                  {{ $patent->copyright->applicant->department->char_department_code }}
						              	</a> 
						                <a href="/admin/maintenance/college/{{ $patent->copyright->applicant->department->int_college_id }}">
						                    {{ $patent->copyright->applicant->department->college->char_college_code }}
						                </a> - 
						                <a href="/admin/maintenance/branch/{{ $patent->copyright->applicant->department->college->int_branch_id }}">
						                      {{ $patent->copyright->applicant->department->college->branch->str_branch_name }}
						                </a>
			                		</td>
			                		<td class="text-center">
			                			Patent: 
			                			<a href="/admin/transaction/patent/to-submit/{{ $patent->int_id }}">
			                				{{ $patent->str_patent_project_title }}
			                			</a>
			                			@if($patent->copyright)
						              		@if($patent->copyright->char_copyright_status == 'to submit')
						              			@if(date('Y-m-d', strtotime($patent->copyright->dtm_schedule)) == date('Y-m-d', strtotime(now())))
									              	Copyright: <a href="/admin/transaction/copyright/to-submit/{{ $patent->copyright->int_id }}">{{ $patent->copyright->str_project_title }}</a>
						              			@endif
						              		@endif
						              	@endif
			                		</td>
			                		<td class="text-center">
			                			<b>{{ date('g:i A', strtotime($patent->dtm_schedule))}}</b>
		                				@if($patent->char_patent_status == 'to submit/conflict')
						              	<small class="text-muted">(Rescheduled)</small>
						              	@endif
						                @if($patent->copyright)
						              		@if($patent->copyright->char_copyright_status == 'to submit')
						              			@if($patent->copyright->dtm_schedule->diffInDays(Carbon\Carbon::now()) == 0)
						              				@if($patent->copyright->dtm_schedule == $patent->dtm_schedule)
									        			{{-- Show nothing --}}
									        		@else
									        		<b>{{ $patent->copyright->dtm_schedule->format('g:i A') }}</b>
									        		@endif
						              			@endif
						              		@endif
						              	@endif
			                		</td>
			                		<td class="text-center">
			                			<a href="/admin/schedule-today/{{ $patent->int_id }}/patent/conflict" role="button" class="btn btn-danger">
			                				<i class="fa fa-times"></i>
			                			</a>
			                		</td>
			                		<td class="text-center">
			                			<a role="button" class="btn btn-info" href="/admin/transaction/patent/to-submit/{{ $patent->int_id }}"><i class="fa fa-check"></i></a>
			                		</td>
			                	</tr>
			                	@empty
			                	<div class="alert alert-info">
									There is no scheduled appointment for today.
								</div>
			                	@endforelse
			                </tbody>
		            	</table>
		        	</div>
				  </div>
				</div>
			</div>
			<div class="card-footer">
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-header" style="background-color: maroon; color: #f3f3f3;">
				<h4>Appointment Status</h4>
			</div>
			<div class="card-body">
				<div class="text-center text-muted">
					<h4>IPR Tally Board ({{ date('m/d/Y', strtotime(now())) }})</h4>
				</div><br>
				<h4>Copyrights</h4>
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="text-center text-success">Successful</th>
							<th class="text-center text-danger">Unsuccessful</th>
							<th class="text-center text-info">To Process</th>
							<th class="text-center text-warning">Total</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td class="text-center text-success">{{ $copySuccessCount }}</td>
						<td class="text-center text-danger">{{ $copyConflictCount }}</td>
						<td class="text-center text-info">{{ $copyToProcessCount }}</td>
						<td class="text-center text-warning">{{ $copyTotalCount }}</td>
					</tr>
					</tbody>
				</table>
				<br>
				<h4>Patents</h4>
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="text-center text-success">Successful</th>
							<th class="text-center text-danger">Unsuccessful</th>
							<th class="text-center text-info">To Process</th>
							<th class="text-center text-warning">Total</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<td class="text-center text-success">{{ $ptntSuccessCount }}</td>
						<td class="text-center text-danger">{{ $ptntConflictCount }}</td>
						<td class="text-center text-info">{{ $ptntToProcessCount }}</td>
						<td class="text-center text-warning">{{ $ptntTotalCount }}</td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div><br>
{{-- Succeed Appointments --}}
<div class="row">
	<div class="col-md-12">	
		<div class="card">
			<div class="card-header" style="color: maroon;">
				<h4>Appointment History</h4>
			</div>
			<div class="card-body">
				<ul class="nav nav-tabs">
		          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#copyrightDone">Copyright</a></li>
		          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#patentDone">Patent</a></li>
		        </ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade active show" id="copyrightDone">
					  	<div class="table-responsive">
			              <table class="table table-hover table-bordered" id="sampleTable">
				                <thead>
				                  <tr>
				                    <th class="text-center">Author - Type</th>
				                    <th class="text-center">Department - College - Branch</th>
				                    <th class="text-center">Work Title</th>
				                    <th class="text-center">Status</th>
				                    <th class="text-center">Schedule</th>
				                    <th class="text-center">Process Start</th>
				                    <th class="text-center">Process End</th>
				                    <th class="text-center">Duration</th>
				                  </tr>
				                </thead>
				                <tbody>
		                	@forelse($copyrightsDone as $copyright)
		                	<tr>
		                		<td class="text-center">
		                			<b>{{ $copyright->applicant->user->str_first_name }} 
						                {{ $copyright->applicant->user->str_last_name }}
						            </b> - {{ $copyright->applicant->char_applicant_type }}
				            	</td>
		                		<td class="text-center">
		                			<a href="/admin/maintenance/department/{{ $copyright->applicant->int_department_id }}">
				                  {{ $copyright->applicant->department->char_department_code }}</a> 
				                  <a href="/admin/maintenance/college/{{ $copyright->applicant->department->int_college_id }}">
				                    {{ $copyright->applicant->department->college->char_college_code }}</a> - 
				                    <a href="/admin/maintenance/branch/{{ $copyright->applicant->department->college->int_branch_id }}">
				                      {{ $copyright->applicant->department->college->branch->str_branch_name }}</a>
		                		</td>
		                		<td class="text-center">
					              	Copyright: {{ $copyright->str_project_title }}
		                		</td>
		                		<td class="text-center">{{ $copyright->char_copyright_status }}</td>
		                		<td class="text-center">
					              	<b>{{ date('g:i A', strtotime($copyright->dtm_schedule))}}<br></b>
					              	{{-- @if($copyright->char_copyright_status == 'to submit/conflict')
					              	<small class="text-muted">(Rescheduled)</small>
					              	@endif --}}
		                		</td>
		                		<td class="text-center">
		            				@if($copyright->dtm_start)
		                			{{ date('g:i A', strtotime($copyright->dtm_start)) }}
		                			@else
		                			( -- )
		                			@endif
		                		</td>
		                		<td class="text-center">
		            				@if($copyright->dtm_end)
		                			{{ date('g:i A', strtotime($copyright->dtm_end)) }}
		                			@else
		                			( -- )
		                			@endif
		                		</td>
		                		<td class="text-center">
		            				@if($copyright->int_duration)
		            					@if($copyright->int_duration < 2)
			            					{{ $copyright->int_duration }} minute
		            					@else
			            					{{ $copyright->int_duration }} minutes
		            					@endif
		                			@else
		                			( -- )
		                			@endif
		                		</td>
		                	</tr>
		                	@empty
		                	<div class="alert alert-warning">There is no record yet.</div>
		                	@endforelse
						        </tbody>
						    </table>
					  	</div>
					</div>
				<div class="tab-pane fade" id="patentDone">
					<div class="table-responsive">
			              <table class="table table-hover table-bordered" id="sampleTable">
				                <thead>
				                  <tr>
				                    <th class="text-center">Author - Type</th>
				                    <th class="text-center">Department - College - Branch</th>
				                    <th class="text-center">Work Title</th>
				                    <th class="text-center">Status</th>
				                    <th class="text-center">Schedule</th>
				                    <th class="text-center">Process Start</th>
				                    <th class="text-center">Process End</th>
				                    <th class="text-center">Duration</th>
				                  </tr>
				                </thead>
				                <tbody>
		                	@forelse($patentsDone as $patent)
		                	<tr>
		                		<td class="text-center">
		                			<b>{{ $patent->copyright->applicant->user->str_first_name }} 
						                {{ $patent->copyright->applicant->user->str_last_name }}
						            </b> - {{ $patent->copyright->applicant->char_applicant_type }}
				            	</td>
		                		<td class="text-center">
		                			<a href="/admin/maintenance/department/{{ $patent->copyright->applicant->int_department_id }}">
				                  {{ $patent->copyright->applicant->department->char_department_code }}</a> 
				                  <a href="/admin/maintenance/college/{{ $patent->copyright->applicant->department->int_college_id }}">
				                    {{ $patent->copyright->applicant->department->college->char_college_code }}</a> - 
				                    <a href="/admin/maintenance/branch/{{ $patent->copyright->applicant->department->college->int_branch_id }}">
				                      {{ $patent->copyright->applicant->department->college->branch->str_branch_name }}</a>
		                		</td>
		                		<td class="text-center">
					              	Patent: {{ $patent->str_patent_project_title }}
		                		</td>
		                		<td class="text-center">{{ $patent->char_patent_status }}</td>
		                		<td class="text-center">
					              	<b>{{ date('g:i A', strtotime($patent->dtm_schedule))}}<br></b>
		                		</td>
		                		<td class="text-center">
		            				@if($patent->dtm_start)
		                			{{ date('g:i A', strtotime($patent->dtm_start)) }}
		                			@else
		                			( -- )
		                			@endif
		                		</td>
		                		<td class="text-center">
		            				@if($patent->dtm_end)
		                			{{ date('g:i A', strtotime($patent->dtm_end)) }}
		                			@else
		                			( -- )
		                			@endif
		                		</td>
		                		<td class="text-center">
		            				@if($patent->int_duration)
		            					@if($patent->int_duration < 2)
			            					{{ $patent->int_duration }} minute
		            					@else
			            					{{ $patent->int_duration }} minutes
		            					@endif
		                			@else
		                			( -- )
		                			@endif
		                		</td>
		                	</tr>
		                	@empty
		                	<div class="alert alert-warning">There is no record yet.</div>
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
{{-- Sweet Alert --}}
{{-- <script src="{{ asset('vali/js/plugins/sweetalert.min.js') }}"></script>
<script>
$('#demoSwal').click(function(){
  swal({
    title: "Are you sure?",
    text: "This copyright request will be classify as a conflict from scheduled appointment",
    type: "info",
    showCancelButton: true,
    confirmButtonText: "Yes!",
    cancelButtonText: "Cancel",
    closeOnConfirm: false,
    closeOnCancel: false
  }, function(isConfirm) {
    if (isConfirm) {
      $('#formConflicts').submit();
      swal("A conflict", "This request was being added to appointment conflict.", "success");
    } else {
      swal("Cancelled", "The action has been cancelled!", "error");
    }
  });
});
</script> --}}
<script>
  $(document).ready(function(){
    $('#li-schedule').addClass('is-expanded');
    $('a[href="{{ route('admin.today') }}"]').addClass('active');
  });
</script>
@endsection