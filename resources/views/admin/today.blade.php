@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-calendar"></i> Appointments Today</h1>
  <p>Today's schedule for submission of requirements for copyright registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Schedule</li>
<li class="breadcrumb-item"><a class="active" href="{{ route('admin.today') }}">Copyright Today</a></li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-8">		
			<div class="tile">
				<div class="tile-body">
					sdad
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
    $('a[href="/admin/copyrights/today"]').addClass('active');
  });
</script>
@endsection