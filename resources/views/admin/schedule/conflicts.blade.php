@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-calendar"></i> Appointment Issues</h1>
  <p>A listing of record having schedule issues to actual submission 
  	of requirements for IPR registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Schedule</li>
<li class="breadcrumb-item">
  <a class="active" href="{{ route('report.schedule-issues') }}">
    Appointment Issues
  </a>
</li>
@endsection
@section('content')
	<div class="tile">
		<div class="tile-body">
			This is where issues regarding to appointments are being handled.
		</div>
	</div>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script>
  $(document).ready(function(){
    $('#li-report').addClass('is-expanded');
    $('a[href="{{ route('report.schedule-issues') }}"]').addClass('active');
  });
</script>
@endsection