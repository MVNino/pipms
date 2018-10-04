@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-calendar"></i> Appointment Issues</h1>
  <p>A listing of record having schedule issues to actual submission 
  	of requirements for IPR registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">
  <a class="active" href="{{ route('reports.schedule-issues') }}">
    Schedule Issues
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
    $('#li-reports').addClass('is-expanded');
    $('a[href="/admin/reports/schedule-issues"]').addClass('active');
  });
</script>
@endsection