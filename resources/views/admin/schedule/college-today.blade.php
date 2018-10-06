@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-calendar"></i> Appointments Today</h1>
  <p>Today's schedule for submission of requirements for copyright registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Schedule</li>
<li class="breadcrumb-item"><a class="active" href="{{ route('admin.today') }}">Today</a></li>
<li class="breadcrumb-item"><a class="active" href="{{ route('admin.today') }}">CCIS</a></li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-8">		
			<div class="card">
				<div class="card-header" style="color: maroon;">
					<h3>TODAY, {{ Carbon\Carbon::now()->format('F d') }}</h3>
				</div>
				<div class="card-body">
					
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
					<div class="row">
						<div class="col-md-10">
							
						</div>
						<div class="col-md-2">
							<span class="badge badge-success badge-pill">
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							</span>
						</div>
					</div>
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